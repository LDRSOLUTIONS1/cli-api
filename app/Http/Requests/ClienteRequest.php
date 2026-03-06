<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('id');

        return [
            'marca_id' => 'required|exists:cli_marcas,id',
            'tipo_cliente_id' => 'required|exists:cli_tipos_cliente,id',
            'tipo_persona' => 'required|in:1,2',
            'regimen_fiscal_id' => 'required|exists:cli_regimenes_fiscales,id',

            'nombre_fisica' => 'nullable|string|max:255',
            'apellido_paterno' => 'nullable|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
            'curp' => 'nullable|string|max:255',

            'representante_legal' => 'nullable|string|max:255',
            'domicilio_fiscal' => 'nullable|string|max:255',

            'correo' => 'required|email|max:255',

            'grupo_id' => 'required|exists:cli_grupos,id',

            'nombre_comercial' => 'required|string|max:255',
            'razon_social' => 'required|string|max:255',
            'rfc' => 'required|string|max:255',

            'repve' => 'required|string|max:255',
            'plaza' => 'required|string|max:255',
            'clasificacion' => 'required|string|max:255',

            'estatus' => 'required|in:Activo,Desarrollo,Inactivo',
            'tipo_negocio' => 'required|in:Matriz,Sucursal',

            'matriz_id' => 'nullable|exists:cli_distribuidores,id',

            'telefono' => 'required|string|max:20',
            'telefono_alt' => 'nullable|string|max:20',

            'modelo' => 'required|array',
            'modelo.*' => 'exists:cli_modelos,id',

            'regional' => 'required|array',
            'regional.*' => 'exists:cli_regionales,id',

            'direccion_principal' => 'required|array',
            'direccion_fiscal' => 'required|array',
        ];
    }

    public function messages()
    {
        return [

            'marca_id.required' => 'La marca es obligatoria',
            'marca_id.exists' => 'La marca seleccionada no existe',

            'tipo_cliente_id.required' => 'El tipo de cliente es obligatorio',
            'tipo_cliente_id.exists' => 'El tipo de cliente seleccionado no existe',

            'tipo_persona.required' => 'El tipo de persona es obligatorio',
            'tipo_persona.in' => 'El tipo de persona debe ser Física o Moral',

            'regimen_fiscal_id.required' => 'El régimen fiscal es obligatorio',
            'regimen_fiscal_id.exists' => 'El régimen fiscal seleccionado no existe',

            'nombre_fisica.string' => 'El nombre debe ser texto',
            'nombre_fisica.max' => 'El nombre no puede superar los 255 caracteres',

            'apellido_paterno.string' => 'El apellido paterno debe ser texto',
            'apellido_paterno.max' => 'El apellido paterno no puede superar los 255 caracteres',

            'apellido_materno.string' => 'El apellido materno debe ser texto',
            'apellido_materno.max' => 'El apellido materno no puede superar los 255 caracteres',

            'fecha_nacimiento.date' => 'La fecha de nacimiento no es válida',

            'curp.string' => 'La CURP debe ser texto',
            'curp.max' => 'La CURP no puede superar los 255 caracteres',

            'representante_legal.string' => 'El representante legal debe ser texto',
            'representante_legal.max' => 'El representante legal no puede superar los 255 caracteres',

            'domicilio_fiscal.string' => 'El domicilio fiscal debe ser texto',
            'domicilio_fiscal.max' => 'El domicilio fiscal no puede superar los 255 caracteres',

            'correo.required' => 'El correo es obligatorio',
            'correo.email' => 'El correo no es válido',
            'correo.max' => 'El correo no puede superar los 255 caracteres',

            'grupo_id.required' => 'El grupo es obligatorio',
            'grupo_id.exists' => 'El grupo seleccionado no existe',

            'nombre_comercial.required' => 'El nombre comercial es obligatorio',
            'nombre_comercial.string' => 'El nombre comercial debe ser texto',
            'nombre_comercial.max' => 'El nombre comercial no puede superar los 255 caracteres',

            'razon_social.required' => 'La razón social es obligatoria',
            'razon_social.string' => 'La razón social debe ser texto',
            'razon_social.max' => 'La razón social no puede superar los 255 caracteres',

            'rfc.required' => 'El RFC es obligatorio',
            'rfc.string' => 'El RFC debe ser texto',
            'rfc.max' => 'El RFC no puede superar los 255 caracteres',

            'repve.required' => 'El REPVE es obligatorio',
            'repve.string' => 'El REPVE debe ser texto',
            'repve.max' => 'El REPVE no puede superar los 255 caracteres',

            'plaza.required' => 'La plaza es obligatoria',
            'plaza.string' => 'La plaza debe ser texto',
            'plaza.max' => 'La plaza no puede superar los 255 caracteres',

            'clasificacion.required' => 'La clasificación es obligatoria',
            'clasificacion.string' => 'La clasificación debe ser texto',
            'clasificacion.max' => 'La clasificación no puede superar los 255 caracteres',

            'estatus.required' => 'El estatus es obligatorio',
            'estatus.in' => 'El estatus debe ser Activo, Desarrollo o Inactivo',

            'tipo_negocio.required' => 'El tipo de negocio es obligatorio',
            'tipo_negocio.in' => 'El tipo de negocio debe ser Matriz o Sucursal',

            'matriz_id.exists' => 'La matriz seleccionada no existe',

            'telefono.required' => 'El teléfono es obligatorio',
            'telefono.string' => 'El teléfono debe ser texto',
            'telefono.max' => 'El teléfono no puede superar los 20 caracteres',

            'telefono_alt.string' => 'El teléfono alternativo debe ser texto',
            'telefono_alt.max' => 'El teléfono alternativo no puede superar los 20 caracteres',

            'modelo.required' => 'Debe seleccionar al menos un modelo',
            'modelo.array' => 'El modelo debe ser una lista válida',
            'modelo.*.exists' => 'Uno de los modelos seleccionados no existe',

            'regional.required' => 'Debe seleccionar al menos una regional',
            'regional.array' => 'La regional debe ser una lista válida',
            'regional.*.exists' => 'Una de las regionales seleccionadas no existe',

            'direccion_principal.required' => 'La dirección principal es obligatoria',
            'direccion_principal.array' => 'La dirección principal debe ser válida',

            'direccion_fiscal.required' => 'La dirección fiscal es obligatoria',
            'direccion_fiscal.array' => 'La dirección fiscal debe ser válida',
        ];
    }
}
