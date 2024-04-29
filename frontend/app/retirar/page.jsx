'use client'
import Head from 'next/head';
import { useState } from 'react';
import { creditAccount } from '../../infrastructure/services/credit-account';
import { toast } from 'react-hot-toast';
import { useRouter } from 'next/navigation';
import { debitAccount } from '../../infrastructure/services/debit-account';

const formatter = new Intl.NumberFormat('en-CO', {
    style: 'currency',
    currency: 'USD'
  });

export default function ConsultarSaldo() {
    const router = useRouter()
    const [state , setState ] = useState({accountNumber: '', amount: 0})
    const handleCreateAmount = async () => {

        if (!state.accountNumber || !state.amount) {
            alert('Debes llenar el campo nombre de usuario y valor inicial')
            return
        }
        const details = await debitAccount({
          accountNumber: state.accountNumber,
          amount: state.amount
        })

        if ('errors' in details) {
          let errors = ''

          for (const error of Object.values(details.errors)) {
            errors += error.join(',') + ', '
          }
          alert(errors)
          return
        }

        toast.success('Retiro realizado Correctamente')

        router.push("/")
    }
  return (
    <div>
      <Head>
        <title>Consignar</title>
        <link rel="icon" href="/favicon.ico" />
      </Head>
        <main>
            <form class="max-w-sm mx-auto">
                <label for="number-input" class="block mb-2 text-sm font-medium text-gray-900 ">Numero de Cuenta:</label>
                <input value={state.accountNumber} onChange={(e) => setState({...state, accountNumber: e.target.value})} type="number" id="number-input" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Numero de cuenta" required />

                <label for="amount-input" class="block mb-2 text-sm font-medium text-gray-900 ">Valor:</label>
                <input value={state.amount} onChange={(e) => setState({...state, amount: e.target.value})} type="number" id="amount-input" aria-describedby="helper-text-explanation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Valor" required />
                <button type="button" onClick={handleCreateAmount} class="mt-[10px] py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 ">Retirar</button>
            </form>
            

        </main>
    </div>
  );
}
