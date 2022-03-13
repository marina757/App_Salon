<h1 class="nombre-pagina">crear cuenta</h1>
<p class="descripcion-pagina">Llena el siguiente formulario para crear una cuenta</p>

<form class="formulario" method="POST" action="/crear-cuenta">
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input 
            type="text"
            name="nombre"
            id="nombre"
            placeholder="Tu nombre">
    </div>

    <div class="campo">
        <label for="apellido">Apellido</label>
        <input 
            type="text"
            name="apellido"
            id="apellido"
            placeholder="Tu Apellido">
    </div>

    <div class="campo">
        <label for="telefono">Telefono</label>
        <input 
            type="tel"
            name="telefono"
            id="telefono"
            placeholder="Tu telefono">
    </div>

    <div class="campo">
        <label for="email">E-mail</label>
        <input 
            type="email"
            name="email"
            id="email"
            placeholder="Tu E-mail">
    </div>

    <div class="campo">
        <label for="password">Password</label>
        <input 
            type="password"
            name="password"
            id="password"
            placeholder="Tu Password">
    </div>

    <input type="submit" value="Crear cuenta" class="boton">

</form>

<div class="acciones">
    <a href="/">Ya tienes una cuenta, inicia sesion</a>
    <a href="/olvide">Olvidaste tu password?</a>
</div>