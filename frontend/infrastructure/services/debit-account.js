const { ProviderAPI } = require("../provider/api");


export const debitAccount = async({ accountNumber, amount }) => {
    const debitDetails = await ProviderAPI.post(`transaction`, { account_number: accountNumber, amount, type: 'debit' })

    return debitDetails
}