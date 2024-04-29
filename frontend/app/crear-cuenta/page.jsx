'use client'
import Head from 'next/head';
import { useState } from 'react';
import { getAmountAccount } from '../../infrastructure/services/get-amount-account';
import { createAccount } from '../../infrastructure/services/create-account';

const formatter = new Intl.NumberFormat('en-CO', {
    style: 'currency',
    currency: 'USD'
  });

export default function CrearCuenta() {

    const [state , setState ] = useState({userName: '', amount: 0})
    const [detailsAccount, setDetailsAccount] = useState(null)
    const handleCreateAmount = async () => {

        if (!state.userName || !state.amount) {
            alert('Debes llenar el campo nombre de usuario y valor inicial ')
            return
        }
        const details = await createAccount({
          userName: state.userName,
          amount: state.amount
        }).catch(e => {
          
        })

        if ('errors' in details) {
          let errors = ''

          for (const error of Object.values(details.errors)) {
            errors += error.join(',') + ', '
          }
          alert(errors)
          return
        }
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
                <label for="number-input" class="block mb-2 text-sm font-medium text-gray-900 ">Nombre de usuario:</label>
                <input onChange={(e) => setState({...state, userName: e.target.value})} type="input" id="number-input" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Nombre de usuario" required />

                <label for="amount-input" class="block mb-2 text-sm font-medium text-gray-900 ">Valor Inicial de la Cuenta:</label>
                <input onChange={(e) => setState({...state, amount: e.target.value})} type="number" id="amount-input" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Valor Inicial de la Cuenta" required />
                <button type="button" onClick={handleCreateAmount} class="mt-[10px] py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 ">Crear</button>
            </form>
            
            {detailsAccount &&
                <div href="#" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 ">
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
