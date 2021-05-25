<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLabelRequest;
use App\Http\Requests\UpdateLabelRequest;
use App\Models\Label;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;

class LabelController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Label::class, 'label');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Label $label): Renderable
    {
        return view('labels.index', ['labels' => $label::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Label $label): Renderable
    {
        return view('labels.create', ['label' => $label]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLabelRequest $request, Label $label): RedirectResponse
    {
        $label
            ->fill($request->validated())
            ->save();

        flash(__('messages.saved'))->success();

        return redirect()->route('labels.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Label $label): Renderable
    {
        return view('labels.edit', ['label' => $label]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLabelRequest $request, Label $label): RedirectResponse
    {
        $label->update($request->validated());

        flash(__('messages.updated'))->success();

        return redirect()->route('labels.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Label $label): RedirectResponse
    {
        if ($label->isDeletable()) {
            $label->delete();

            flash(__('messages.labels.deleted'))->success();
        } else {
            flash(__('messages.labels.failed'))->error();
        }

        return redirect()->route('labels.index');
    }
}
