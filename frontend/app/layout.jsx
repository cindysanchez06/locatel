export const metadata = {
  title: 'Next.js',
  description: 'Generated by Next.js',
}

import "../styles/global.css"
import Link from 'next/link'

import { Toaster } from "react-hot-toast";

export default function RootLayout({ children }) {
  return (
    <html lang="en">
      <body>
        <Toaster position="bottom-center" />
        <div className="flex gap-[20px] h-[100vh] w-[100vw] items-center justify-center">
          <div className="flex flex-col gap-[10px]">
            <a href="/crear-cuenta" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 ">Crear Cuenta</a>
            <a href="/consultar-saldo" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 ">Consultar Saldo</a>
          </div>
          <div className="">
            {children}
          </div>
          <div className="flex flex-col gap-[10px]">
            <a href="/consignar" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 ">Consignar</a>
            <a href="/retirar" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 ">Retirar</a>
          </div>
        </div>
        
       </body>
    </html>
  )
}
