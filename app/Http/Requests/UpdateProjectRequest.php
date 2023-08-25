<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'type_id' => 'required|exists:types,id',
            'title' => 'required|max:50',
            'description' => 'required',
            'date_of_creation' => 'required',
            'cover_image' => 'image',

            'technologies' => 'required|exists:technologies,id',
        ];
    }

    public function messages()
    {
        return [
            'type_id.required' => 'Devi selezionare una Tipologia',
            'type_id.exists' => 'Tipologia selezionata non valida',

            'title.required' => 'Il titolo è obbligatorio',
            'title.max' => 'Il titolo deve avere una lunghezza massima di :max caratteri',

            'description.required' => 'La descrizione è obbligatoria',

            'date_of_creation.required' => 'La data di creazione è obbligatoria',

            'cover_image.image' => 'Il file inserito deve essere un\'immagine!',

            'technologies.required' => 'Devi selezionare almeno una Tecnologia',
            'technologies.exists' => 'Tecnologia selezionata non valida',
        ];
    }
}
