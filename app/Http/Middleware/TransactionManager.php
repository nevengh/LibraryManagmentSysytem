<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class TransactionManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        DB::beginTransaction();
        try {

            $response = $next($request);


            DB::commit();


            return $response;
        } catch (\Exception $e) {

            DB::rollBack();


            // Handle the exception here

            Log::error($e);

            return response()->json(['message' => 'An error occurred while processing the request.'], 500);
            // throw $e; // Re-throw the exception so it can be handled by the application's error handling

        }
    }
}
