<?php

use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login as AuthLogin;
use App\Livewire\Dashboard;
use App\Livewire\Dashboard\DashboardIndex;
use App\Livewire\EsqueciSenha;
use App\Livewire\EsqueciSenha\ResetPassword;
use App\Livewire\Estoque;
use App\Livewire\Estoques\EstoqueCreate;
use App\Livewire\Estoques\EstoqueIndex;
use App\Livewire\Login;
use App\Livewire\Produtos;
use App\Livewire\Produtos\ProdutosCreate;
use App\Livewire\Produtos\ProdutosEdit;
use App\Livewire\Produtos\ProdutosIndex;
use App\Livewire\Usuarios;
use App\Livewire\Usuarios\UsuariosCreate;
use App\Livewire\Usuarios\UsuariosEdit;
use App\Livewire\Usuarios\UsuariosIndex;
use App\Models\Produto;
use App\Models\Usuario;
use Illuminate\Support\Facades\Route;
//*usuarios
  Route::get('usuario/create', UsuariosCreate::class)->name('usuarios.create');
 Route::get('usuario/index', UsuariosIndex::class)->name('usuarios.index');
 Route::get('/usuarios/edit/{userId}', UsuariosEdit::class)->name('usuarios.edit');

 //* produtos 
 Route::get('/produtos/index', ProdutosIndex::class)->name('produtos.index');
Route::get('/produtos/create', ProdutosCreate::class)->name('produtos.create');
Route::get('/produtos/edit/{produtoId}', ProdutosEdit::class)->name('produtos.edit');

//* estoque 
Route::get('/estoques/index', EstoqueIndex::class)->name('estoques.index');
Route::get('/estoques/create', EstoqueCreate::class)->name('estoques.create');

//* dashboard
Route::get('dashboard', DashboardIndex::class)->name('dashboard');

//*login
Route::get('login',AuthLogin::class)->name('login');

//* logout
Route::get('/logout', function () {    session()->flush(); 
 return redirect()->route('login');
})->name('logout');


//* esqueci senha 
Route::get('forgot-password',ForgotPassword::class)->name('password.request');



Route::get('/reset-password/{token}', ResetPassword::class)->name('password.reset');




