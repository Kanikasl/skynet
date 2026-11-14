<?php

namespace App\Livewire;

use App\Models\Cliente;
use App\Models\Cuenta;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Cuentas extends Component
{
    public $cuenta_id = null;
    public $cliente_id = '';
    public $numero_cuenta = '';
    public $tipo_cuenta = 'Ahorro';
    public $saldo = 0;

    protected function rules()
    {
        return [
            'cliente_id' => 'required|exists:clientes,id',
            'numero_cuenta' => 'required|string|max:30|unique:cuentas,numero_cuenta,' . $this->cuenta_id,
            'tipo_cuenta' => 'required|in:Ahorro,Monetaria',
            'saldo' => 'required|numeric|min:0',
        ];
    }

    public function guardar()
    {
        $this->validate();

        Cuenta::updateOrCreate(
            ['id' => $this->cuenta_id],
            [
                'cliente_id' => $this->cliente_id,
                'numero_cuenta' => $this->numero_cuenta,
                'tipo_cuenta' => $this->tipo_cuenta,
                'saldo' => $this->saldo,
            ]
        );

        session()->flash('mensaje', $this->cuenta_id ? 'Cuenta actualizada' : 'Cuenta creada');
        $this->limpiar();
    }

    public function editar($id)
    {
        $c = Cuenta::findOrFail($id);
        $this->cuenta_id = $c->id;
        $this->cliente_id = $c->cliente_id;
        $this->numero_cuenta = $c->numero_cuenta;
        $this->tipo_cuenta = $c->tipo_cuenta;
        $this->saldo = $c->saldo;
    }

    public function eliminar($id)
    {
        Cuenta::findOrFail($id)->delete();
        session()->flash('mensaje', 'Cuenta eliminada');
    }

    public function limpiar()
    {
        $this->reset(['cuenta_id', 'cliente_id', 'numero_cuenta', 'saldo']);
        $this->tipo_cuenta = 'Ahorro';
        $this->saldo = 0;
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.cuentas', [
            'cuentas' => Cuenta::with('cliente')->orderBy('id', 'desc')->get(),
            'clientes' => Cliente::orderBy('nombre_completo')->get(),
        ]);
    }
}