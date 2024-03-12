<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CurrencyConversion;
use App\Models\Balance;
use Illuminate\Support\Facades\Auth;

class CurrencyConversionController extends Controller
{
    /**
 * Store a newly created currency conversion in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
public function store(Request $request)
{
    // Valider les données du formulaire
    $validatedData = $request->validate([
        'currency1' => 'required|in:htg,usd',
        'currency2' => 'required|in:htg,usd',
        'amount' => 'required|numeric',
    ]);

    // Vérifier si les devises sélectionnées sont les mêmes
    if ($validatedData['currency1'] === $validatedData['currency2']) {
        return redirect()->back()->with('error', 'Cannot convert same currency.');
    }

    // Calculer le montant converti
    $convertedAmount = $this->convertCurrency($validatedData['currency1'], $validatedData['currency2'], $validatedData['amount']);

    // Vérifier si le solde est suffisant
    if (!$this->checkSufficientBalance($validatedData['currency1'], $validatedData['amount'])) {
        return redirect()->back()->with('error', 'Insufficient balance.');
    }

    // Enregistrer la conversion de devise
    $this->saveCurrencyConversion($validatedData, $convertedAmount);

    // Mettre à jour la balance de l'utilisateur
    $this->updateUserBalance($validatedData['currency1'], $validatedData['currency2'], $validatedData['amount'], $convertedAmount);

    // Rediriger avec un message de succès
    return redirect()->back()->with('success', 'Currency conversion saved successfully and balance updated.');
}

    /**
     * Check if the balance is sufficient for the conversion.
     *
     * @param string $currency
     * @param float $amount
     * @return bool
     */
    private function checkSufficientBalance($currency, $amount)
    {
        $userId = Auth::id();
        $balance = Balance::where('user_id', $userId)->first();

        if (!$balance) {
            return false; // Si la balance n'existe pas, considérez-la comme insuffisante
        }

        if ($currency === 'htg') {
            return $balance->htg_balance >= $amount;
        } else {
            return $balance->usd_balance >= $amount;
        }
    }

    /**
     * Save the currency conversion record.
     *
     * @param array $data
     * @param float $convertedAmount
     * @return void
     */
    private function saveCurrencyConversion($data, $convertedAmount)
    {
        $conversion = new CurrencyConversion();
        $conversion->user_id = Auth::id();
        $conversion->user_email = Auth::user()->email;
        $conversion->currency_from = $data['currency1'];
        $conversion->currency_to = $data['currency2'];
        $conversion->amount = $data['amount'];
        $conversion->converted_amount = $convertedAmount;
        $conversion->save();
    }

    /**
     * Update user balance based on currency conversion.
     *
     * @param string $currencyFrom
     * @param string $currencyTo
     * @param float $amount
     * @param float $convertedAmount
     * @return void
     */
    private function updateUserBalance($currencyFrom, $currencyTo, $amount, $convertedAmount)
    {
        $userId = Auth::id();
        $balance = Balance::where('user_id', $userId)->first();

        if (!$balance) {
            // Si la balance n'existe pas, vous pouvez choisir de la créer ici
            return;
        }

        if ($currencyFrom === 'htg') {
            // Réduire le montant de currencyFrom (HTG) de la balance
            $balance->htg_balance -= $amount;
        } else {
            // Réduire le montant de currencyFrom (USD) de la balance
            $balance->usd_balance -= $amount;
        }

        if ($currencyTo === 'htg') {
            // Ajouter le montant converti (HTG) à la balance
            $balance->htg_balance += $convertedAmount;
        } else {
            // Ajouter le montant converti (USD) à la balance
            $balance->usd_balance += $convertedAmount;
        }

        // Enregistrer les modifications de la balance
        $balance->save();
    }

    /**
     * Convert currency.
     *
     * @param  string  $currencyFrom
     * @param  string  $currencyTo
     * @param  float  $amount
     * @return float
     */
    private function convertCurrency($currencyFrom, $currencyTo, $amount)
    {
        // Logique pour convertir la devise
        $usdToHtgRate = 136.192950; // 1 USD = 136.192950 HTG
        $htgToUsdRate = 0.007342; // 1 HTG = 0.007342 USD

        if ($currencyFrom === 'usd' && $currencyTo === 'htg') {
            // Conversion de USD en HTG
            return $amount * $usdToHtgRate;
        } elseif ($currencyFrom === 'htg' && $currencyTo === 'usd') {
            // Conversion de HTG en USD
            return $amount * $htgToUsdRate;
        }

        // Si les devises ne sont pas convertibles, retourner le montant d'origine
        return $amount;
    }
}
