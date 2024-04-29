const { ProviderAPI } = require("../provider/api");


export const createAccount = async({ userName, amount }) => {
    const accountInfo = await ProviderAPI.post(`account`, { user_name: userName, amount })

    return accountInfo
}