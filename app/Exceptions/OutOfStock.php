<?php

namespace App\Exceptions;

use Exception;
use Session;

/**
 * OutOfStockException
 *
 */
class OutOfStock extends Exception
{
    /**
     * Report the exception
     *
     * @return void
     */
    public function report()
    {
        // Session::flash('alert', $e->getMessage());
        // return \\ ??

        // Session::flash('success', 'Whoops');
        // return \redirect()->back();
        \Log::debug('produk kurang dari stock');
    }
}
