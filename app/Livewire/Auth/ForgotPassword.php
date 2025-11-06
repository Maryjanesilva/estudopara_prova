<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class ForgotPassword extends Component
{
      public $email;
    public $message;
    public $error;

    protected $rules = [
        'email' => 'required|email|exists:usuarios,email',
    ];

    protected $messages = [
        'email.required' => 'O email é obrigatório.',
        'email.email' => 'Digite um email válido.',
        'email.exists' => 'Este email não está cadastrado no sistema.',
    ];

    public function sendResetLink()
    {
        $this->validate();
        $this->message = null;
        $this->error = null;

        try {
            // Buscar usuário pelo email
            $usuario = Usuario::where('email', $this->email)->first();

            if ($usuario) {
                // Gerar token de recuperação (simulação)
                $token = Str::random(60);
                
                // Aqui você pode:
                // 1. Enviar email com link de recuperação
                // 2. Salvar o token no banco de dados
                // 3. Redirecionar para página de reset

                // Por enquanto, vamos mostrar uma mensagem simples
                $this->message = "📧 Email de recuperação enviado para: {$this->email}";
                $this->email = '';

                // Simulação de envio de email
                // Mail::to($usuario->email)->send(new PasswordResetMail($token));
            }

        } catch (\Exception $e) {
            $this->error = 'Erro ao processar solicitação. Tente novamente.';
        }
    }
    public function render()
    {
        return view('livewire.auth.forgot-password')->layout('components.layouts.auth');
    }
}
