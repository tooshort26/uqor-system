<?php

namespace App\Http\Controllers\Repository;

use App\Form;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;


class FormRepository
{
	private $form;

	public function __construct(Form $form)
	{
		$this->form = $form;
	}

	private function getTheCurrentQuarter() : int
	{
		return Carbon::now()->quarter;
	}

	private function getTheCurrentYear() : int
	{
		return date('Y');
	}

	/**
	 * Get all forms that submitted for this year and quarter
	 */
	public function getFormForThisYearAndQuarter() : Collection
	{
		$currentYear    = $this->getTheCurrentYear();
		$currentQuarter = $this->getTheCurrentQuarter();

		$forms = $this->form->where('quarter', $currentQuarter)
							->whereYear('created_at', $currentYear)
							->get(['quarter', 'created_at']);

		return $forms->unique('quarter');
	}

	/**
	 * Return if the administrator already submti a form for this year and quarter
	 */
	public function remindSubmission() : bool
	{
		$forms = Arr::flatten(
					$this->getFormForThisYearAndQuarter()
						 ->pluck('quarter')
				);
		return in_array($this->getTheCurrentQuarter(), $forms);
	}

}
