const { ProviderAPI } = require("../provider/api");


export const getAmountAccount = async(accountNumber) => {
    const accountInfo = await ProviderAPI.get(`account/${accountNumber}`)

    return accountInfo
}