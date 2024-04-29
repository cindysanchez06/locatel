'use client'
import Head from 'next/head';
import { useState } from 'react';
import { getAmountAccount } from '../../infrastructure/services/get-amount-account';

const formatter = new Intl.NumberFormat('en-CO', {
    style: 'currency',
    currency: 'USD'
  });

export default function ConsultarSaldo() {

    const [accountNumber , setAccountNumber ] = useState('')

    const [detailsAccount, setDetailsAccount] = useState(null)
    const handleGetAmount = async () => {

        if (!accountNumber.length) {
            alert('Debes llenar el campo numero de cuenta')
            return
        }
        const details = await getAmountAccount(accountNumber)
        setDetailsAccount(details)
        console.log(details)
    }
  return (
    <div>
      <Head>
        <title>Consultar Saldo</title>
        <link rel="icon" href="/favicon.ico" />
      </Head>
        <main>
            <form class="max-w-sm mx-auto">
                <label for="number-input" class="block mb-2 text-sm font-medium text-gray-900 ">Numero de cuenta:</label>
                <input onChange={(e) => setAccountNumber(e.target.value)} type="number" id="number-input" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Numero de cuenta" required />
                <button type="button" onClick={handleGetAmount} class="mt-[10px] py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 ">Buscar</button>
            </form>
            
            {detailsAccount &&
                <div  class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 ">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">Saldo: {formatter.format(detailsAccount.amount)}</h5>
                    <p class="font-normal text-gray-700 ">Nombre de usuario: {detailsAccount.user_name}</p>
                    <p class="font-normal text-gray-700 ">Numero De cuenta: {detailsAccount.account_number}</p>
                    {/* <p class="font-normal text-gray-700 ">Fecha de Creacion: {detailsAccount.created_at}</p> */}
                </div>
            }

        </main>
    </div>
  );
}
