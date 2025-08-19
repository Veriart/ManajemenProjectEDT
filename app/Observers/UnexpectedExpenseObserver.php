<?php

namespace App\Observers;

use App\Models\UnexpectedExpense;

class UnexpectedExpenseObserver
{
    /**
     * Handle the UnexpectedExpense "created" event.
     */
    public function created(UnexpectedExpense $unexpectedExpense): void
    {
        $this->updateProjectExpenses($unexpectedExpense);
    }

    /**
     * Handle the UnexpectedExpense "updated" event.
     */
    public function updated(UnexpectedExpense $unexpectedExpense): void
    {
        $this->updateProjectExpenses($unexpectedExpense);
    }

    /**
     * Handle the UnexpectedExpense "deleted" event.
     */
    public function deleted(UnexpectedExpense $unexpectedExpense): void
    {
        $this->updateProjectExpenses($unexpectedExpense);
    }

    /**
     * Update the project expenses
     */
    private function updateProjectExpenses(UnexpectedExpense $unexpectedExpense): void
    {
        $project = $unexpectedExpense->project;
        if ($project) {
            $project->calculateExpenses();
        }
    }
}