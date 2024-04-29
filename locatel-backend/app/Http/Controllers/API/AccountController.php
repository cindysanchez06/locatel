<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Services\api\Account\AccountService;
use App\Services\api\Account\CreateAccountService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AccountController extends Controller
{
    /**
     * @var CreateAccountService
     */
    private CreateAccountService $createAccountService;
    /**
     * @var AccountService
     */
    private AccountService $accountService;

    /**
     * @param CreateAccountService $createAccountService
     * @param AccountService $accountService
     */
    public function __construct(CreateAccountService $createAccountService, AccountService $accountService)
    {
        $this->createAccountService = $createAccountService;
        $this->accountService = $accountService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $request->merge(['account_number' => $this->accountService->generateNumberAccount(10)]);
            $validatedData = $request->validate(Account::$rules);
            $account = $this->createAccountService->create($validatedData);
            return response()->json($account, 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (Exception $e) {
            return response()->json(['errors' => $e->getMessage() ?? "Ocurrio un error"], 500);
        }
    }

    /**
     * @param string $accountNumber
     * @return JsonResponse
     */
    public function show(string $accountNumber): JsonResponse
    {
        try {
            $account = Account::where('account_number', $accountNumber)->first();
            return response()->json($account, 200);
        } catch (Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 500);
        }
    }
}
