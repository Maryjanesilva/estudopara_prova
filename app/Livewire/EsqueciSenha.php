<?php

namespace App\Livewire;

use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class EsqueciSenha extends Component
{
    public $email;
    public $message;
    public $error;
    public $codigoEnviado = false;
    public $codigo;
    public $novaSenha;
    public $confirmarSenha;

    protected $rules = [
        'email' => 'required|email|exists:usuarios,email',
    ];

    protected $messages = [
        'email.required' => 'O email é obrigatório.',
        'email.email' => 'Digite um email válido.',
        'email.exists' => 'Este email não está cadastrado no sistema.',
    ];

    public function enviarCodigo()
    {
        $this->validate();
        $this->message = null;
        $this->error = null;

        try {
            $usuario = Usuario::where('email', $this->email)->first();

            if ($usuario) {
                // Gerar um código simples (na prática, enviaria por email)
                $codigo = Str::random(6);
                session(['codigo_recuperacao' => $codigo, 'email_recuperacao' => $this->email]);
                
                $this->codigoEnviado = true;
                $this->message = "📧 Código de verificação enviado para: {$this->email}";
                $this->error = null;
                
                // Em produção, você enviaria o código por email
                // Por enquanto, mostramos no console para teste
                \log()::info("Código de recuperação para {$this->email}: {$codigo}");
            }

        } catch (\Exception $e) {
            $this->error = 'Erro ao processar solicitação. Tente novamente.';
        }
    }

    public function redefinirSenha()
    {
        $this->validate([
            'codigo' => 'required',
            'novaSenha' => 'required|min:6',
            'confirmarSenha' => 'required|same:novaSenha',
        ], [
            'codigo.required' => 'Digite o código recebido.',
            'novaSenha.required' => 'A nova senha é obrigatória.',
            'novaSenha.min' => 'A senha deve ter pelo menos 6 caracteres.',
            'confirmarSenha.required' => 'Confirme sua senha.',
            'confirmarSenha.same' => 'As senhas não coincidem.',
        ]);

        // Verificar código (simulação)
        $codigoSalvo = session('codigo_recuperacao');
        $emailSalvo = session('email_recuperacao');

        if ($this->codigo === $codigoSalvo && $this->email === $emailSalvo) {
            try {
                $usuario = Usuario::where('email', $this->email)->first();
                $usuario->update([
                    'senha' => Hash::make($this->novaSenha)
                ]);

                session()->forget(['codigo_recuperacao', 'email_recuperacao']);
                
                session()->flash('success', 'Senha redefinida com sucesso!');
                return redirect()->route('login');

            } catch (\Exception $e) {
                $this->error = 'Erro ao redefinir senha. Tente novamente.';
            }
        } else {
            $this->error = 'Código inválido ou expirado.';
        }
    }

    public function voltar()
    {
        $this->codigoEnviado = false;
        $this->email = '';
        $this->codigo = '';
        $this->novaSenha = '';
        $this->confirmarSenha = '';
        $this->message = null;
        $this->error = null;
    }

    public function render()
    {
        return view('livewire.esqueci-senha')->layout('components.layouts.auth');
    }
}
