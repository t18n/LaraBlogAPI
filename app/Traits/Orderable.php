<?php

namespace App\Traits;

trait Orderable
{
	public function latestFirst($query)
	{
		return $query->orderBy('created_at', 'desc');
	}

	public function oldestFirst($query)
	{
		return $query->orderBy('created_at', 'asc');
	}
}