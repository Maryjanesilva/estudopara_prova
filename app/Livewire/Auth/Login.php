<?php

namespace App\Livewire\Auth;

use App\Models\Usuario;
use Livewire\Component;

class Login extends Component
{
     public $email;
    public $senha;
    public $lembrar = false;
    public $erro;

    protected $rules = [
        'email' => 'required|email',
        'senha' => 'required|min:6',
    ];

    protected $messages = [
        'email.required' => 'O email é obrigatório.',
        'email.email' => 'Digite um email válido.',
        'senha.required' => 'A senha é obrigatória.',
        'senha.min' => 'A senha deve ter pelo menos 6 caracteres.',
    ];

    public function login()
    {
        $this->validate();
        $this->erro = null;

        // Buscar usuário pelo email
        $usuario = Usuario::where('email', $this->email)->first();

        if ($usuario && password_verify($this->senha, $usuario->senha)) {
            // Login manual
            session(['usuario_id' => $usuario->id, 'usuario_nome' => $usuario->nome]);
            
            session()->flash('success', 'Login realizado com sucesso!');
            return redirect()->route('dashboard');
        }

        $this->erro = 'Email ou senha incorretos.';
        $this->senha = ''; // Limpa a senha por segurança
    }

    public function render()
    {
        return view('livewire.auth.login')
        ->layout('components.layouts.auth');
    }
}
