<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Models\NumSeq;

class FibController extends Controller
{
    
    public function index(Request $request): JsonResponse
    {   
        try {
            $n = (int) $request->input('n');
            $result = NumSeq::fib($n);
            return response()->json(['result' => $result], 200);
        } catch (\InvalidArgumentException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        } catch (\RangeException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}