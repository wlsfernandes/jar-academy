<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Helpers\StorageS3;
use App\Models\Test;
use Exception;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $test = Test::findOrFail($id);
            $test->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Test deleted successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error deleting discipline: ' . $e->getMessage());

            return redirect()->back()->with('error', 'The delete process fail.');
        }
    }

}
