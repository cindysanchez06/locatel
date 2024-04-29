class ProviderAPIClass {

    get(url) {
        return fetch(`${process.env.NEXT_PUBLIC_API}${url}`).then((response) => response.json())
    }

    post(url, data) {
        return fetch(`${process.env.NEXT_PUBLIC_API}${url}`, {
            method: 'POST',
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(data)
        }).then((response) => response.json())
    }
}

export const ProviderAPI = new ProviderAPIClass()