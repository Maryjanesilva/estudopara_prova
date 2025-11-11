<?php

namespace App\Livewire\EsqueciSenha;

use Carbon\Carbon;
use Illuminate\Container\Attributes\DB;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Livewire\Component;

class ResetPassword extends Component
{
     public $email;
    public $token;
    public $password;
    public $password_confirmation;
    public $message = '';
    public $error = '';

    // Este método é executado automaticamente quando o componente é carregado
    // A partir da URL (ex: /reset-password/{token}?email=...)
    public function mount($token, $email = null)
    {
        $this->token = $token;
        $this->email = $email;

        // Opcional: Verificar se o token existe no banco de dados imediatamente
        $passwordReset = DB::table('password_resets')
                            ->where('token', $this->token)
                            ->first();
        
        if (!$passwordReset) {
            $this->error = 'Este link de redefinição é inválido ou expirou.';
        } elseif ($this->email && $passwordReset->email != $this->email) {
            $this->error = 'Token inválido para este e-mail.';
        }
    }
    public function render()
    {
        return view('livewire.esqueci-senha.reset-password');
    }
      public function resetPassword()
    {
        // Limpa mensagens
        $this->message = '';
        $this->error = '';

        // 1. Validação das senhas
        $this->validate([
            'email' => 'required|email|exists:users',
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
        ], [
            'email.required' => 'O e-mail é obrigatório.',
            'email.exists' => 'E-mail não encontrado.',
            'password.required' => 'A senha é obrigatória.',
            'password.confirmed' => 'A confirmação de senha não confere.',
            'password.*' => 'A senha deve ter no mínimo 8 caracteres, incluir letras maiúsculas, minúsculas, números e símbolos.'
        ]);

        // 2. Verificar se o token ainda é válido no banco de dados
        $passwordReset = DB::table('password_resets')
                            ->where('email', $this->email)
                            ->where('token', $this->token)
                            ->first();

        if (!$passwordReset || Carbon::parse($passwordReset->created_at)->addHour()->isPast()) {
            $this->error = 'O link de redefinição é inválido ou expirou. Solicite um novo link.';
            return;
        }

        // 3. Atualizar a senha do usuário
        $user = User::where('email', $this->email)->first();
        $user->password = Hash::make($this->password);
        $user->save();

        // 4. Remover o token do banco de dados para que não possa ser reutilizado
        DB::table('password_resets')->where('email', $this->email)->delete();

        // 5. Feedback e redirecionamento (opcionalmente logar o usuário automaticamente)
        auth()->login($user); // Loga o usuário automaticamente
        
        // Redireciona para o painel principal da loja
        return redirect()->route('dashboard')->with('status', 'Senha redefinida com sucesso! Você está logado.');
    }
}
