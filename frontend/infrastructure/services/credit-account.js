const { ProviderAPI } = require("../provider/api");


export const creditAccount = async({ accountNumber, amount }) => {
    const creditDetails = await ProviderAPI.post(`transaction`, { account_number: accountNumber, amount, type: 'credit' })

    return creditDetails
}