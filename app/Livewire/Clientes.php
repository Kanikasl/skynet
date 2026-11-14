<?php

namespace App\Livewire;

use App\Models\Cliente;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Clientes extends Component
{
    public $cliente_id = null;
    public $nombre_completo = '';
    public $correo = '';
    public $telefono = '';
    public $direccion = '';
    public $buscar = '';

    protected function rules()
    {
        return [
            'nombre_completo' => 'required|string|max:255',
            'correo' => 'required|email|unique:clientes,correo,' . $this->cliente_id,
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:255',
        ];
    }

    public function guardar()
    {
        $this->validate();

        Cliente::updateOrCreate(
            ['id' => $this->cliente_id],
            [
                'nombre_completo' => $this->nombre_completo,
                'correo' => $this->correo,
                'telefono' => $this->telefono,
                'direccion' => $this->direccion,
            ]
        );

        session()->flash('mensaje', $this->cliente_id ? 'Cliente actualizado' : 'Cliente creado');
        $this->limpiar();
    }

    public function editar($id)
    {
        $c = Cliente::findOrFail($id);
        $this->cliente_id = $c->id;
        $this->nombre_completo = $c->nombre_completo;
        $this->correo = $c->correo;
        $this->telefono = $c->telefono;
        $this->direccion = $c->direccion;
    }

    public function eliminar($id)
    {
        Cliente::findOrFail($id)->delete();
        session()->flash('mensaje', 'Cliente eliminado');
    }

    public function limpiar()
    {
        $this->reset(['cliente_id', 'nombre_completo', 'correo', 'telefono', 'direccion']);
        $this->resetValidation();
    }

    public function render()
    {
        $clientes = Cliente::withCount('cuentas')
            ->withSum('cuentas', 'saldo')
            ->where('nombre_completo', 'like', '%' . $this->buscar . '%')
            ->orderBy('id', 'desc')
            ->get();

        return view('livewire.clientes', compact('clientes'));
    }
}