<li class="nav-item {{ Request::is('home') ? 'active' : '' }}">
    <a href="{{ url('home') }}">
        <i class="fas fa-home"></i>
        <p>Dashboard</p>
    </a>
</li>
<li class="nav-section">
    <span class="sidebar-mini-icon">
        <i class="fa fa-ellipsis-h"></i>
    </span>
    <h4 class="text-section">Componentes</h4>
</li>
<li
    class="nav-item
    {{ Request::is('productos') || Request::is('categoria') || Request::is('etiqueta') || Request::is('fabricante') ? 'active' : '' }}">
    <a data-toggle="collapse" href="#catalogo">
        <i class="fas fa-box"></i>
        <p>Catalogo</p>
        <span class="caret"></span>
    </a>
    <div class="collapse {{ Request::is('productos') || Request::is('categoria') || Request::is('etiqueta') || Request::is('fabricante') ? 'show' : '' }}"
        id="catalogo">
        <ul class="nav nav-collapse">
            @foreach ($activeModules as $module)
                @switch($module->getName())
                    @case('Productos')
                        <li class="{{ Request::is('productos') ? 'active' : '' }}">
                            <a href="{{ url('productos') }}">
                                <span class="sub-item">Productos</span>
                            </a>
                        </li>
                    @break

                    @case('Categoria')
                        <li class="{{ Request::is('categoria') ? 'active' : '' }}">
                            <a href="{{ url('categoria') }}">
                                <span class="sub-item">Categorias</span>
                            </a>
                        </li>
                    @break

                    @case('Etiquetas')
                        <li class="{{ Request::is('etiqueta') ? 'active' : '' }}">
                            <a href="{{ url('etiqueta') }}">
                                <span class="sub-item">Etiquetas</span>
                            </a>
                        </li>
                    @break

                    @case('Fabricante')
                        <li class="{{ Request::is('fabricante') ? 'active' : '' }}">
                            <a href="{{ url('fabricante') }}">
                                <span class="sub-item">Fabricante</span>
                            </a>
                        </li>
                    @break
                @endswitch
            @endforeach
        </ul>
    </div>
</li>
<li class="nav-item
    {{ Request::is('inventario') || Request::is('devolucion') ? 'active' : '' }}">
    <a data-toggle="collapse" href="#inventario">
        <i class="fas fa-boxes"></i>
        <p>Inventario</p>
        <span class="caret"></span>
    </a>
    <div class="collapse {{ Request::is('inventario') || Request::is('devolucion') ? 'show' : '' }}" id="inventario">
        <ul class="nav nav-collapse">
            @foreach ($activeModules as $module)
                @switch($module->getName())
                    @case('Inventario')
                        <li class="{{ Request::is('inventario') ? 'active' : '' }}">
                            <a href="{{ url('inventario') }}">
                                <span class="sub-item">Inventario</span>
                            </a>
                        </li>
                    @break

                    @case('Devolucion')
                        <li class="{{ Request::is('devolucion') ? 'active' : '' }}">
                            <a href="{{ url('devolucion') }}">
                                <span class="sub-item">Devolucion</span>
                            </a>
                        </li>
                    @break
                @endswitch
            @endforeach
        </ul>
    </div>
</li>
<li
    class="nav-item
    {{ Request::is('contabilidad') ||
    Request::is('contabilidad/ingresos') ||
    Request::is('contabilidad/gastos') ||
    Request::is('contabilidad/cuentas') ||
    Request::is('contabilidad/transacciones') ||
    Request::is('contabilidad/cuentas-por-pagar') ||
    Request::is('contabilidad/cuentas-por-cobrar') ||
    Request::is('contabilidad/balance')
        ? 'active'
        : '' }}">
    <a data-toggle="collapse" href="#contabilidad">
        <i class="fas fa-chart-bar"></i>
        <p>Contabilidad</p>
        <span class="caret"></span>
    </a>
    <div class="collapse {{ Request::is('contabilidad') ||
    Request::is('contabilidad/ingresos') ||
    Request::is('contabilidad/gastos') ||
    Request::is('contabilidad/cuentas') ||
    Request::is('contabilidad/transacciones') ||
    Request::is('contabilidad/cuentas-por-pagar') ||
    Request::is('contabilidad/cuentas-por-cobrar') ||
    Request::is('contabilidad/balance')
        ? 'show'
        : '' }}"
        id="contabilidad">
        <ul class="nav nav-collapse">
            <li class="{{ Request::is('contabilidad/ingresos') ? 'active' : '' }}">
                <a href="{{ url('contabilidad/ingresos') }}">
                    <span class="sub-item">Ingresos</span>
                </a>
            </li>
            <li class="{{ Request::is('contabilidad/gastos') ? 'active' : '' }}">
                <a href="{{ url('contabilidad/gastos') }}">
                    <span class="sub-item">Gastos</span>
                </a>
            </li>
            <li
                class="nav-item {{ Request::is('contabilidad/cuentas') || Request::is('contabilidad/transacciones') ? 'active' : '' }}">
                <a data-toggle="collapse" href="#cuentas_general">
                    <p>Cuentas General</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse {{ Request::is('contabilidad/cuentas') || Request::is('contabilidad/transacciones') ? 'show' : '' }}"
                    id="cuentas_general">
                    <ul class="nav nav-collapse">
                        <li class="{{ Request::is('contabilidad/cuentas') ? 'active' : '' }}">
                            <a href="{{ url('contabilidad/cuentas') }}">
                                <span class="sub-item">Cuentas Bancaria</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('contabilidad/transacciones') ? 'active' : '' }}">
                            <a href="{{ url('contabilidad/transacciones') }}">
                                <span class="sub-item">Transacciones Bancaria</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li
                class="nav-item {{ Request::is('contabilidad/cuentas-por-pagar') || Request::is('contabilidad/cuentas-por-cobrar') ? 'active' : '' }}">
                <a data-toggle="collapse" href="#cuentas_cobrar_pagar">
                    <p>Cuentas x cobrar y pagar</p>
                    <span class="caret"></span>
                </a>
                <div class="collapse {{ Request::is('contabilidad/cuentas-por-pagar') || Request::is('contabilidad/cuentas-por-cobrar') ? 'show' : '' }}"
                    id="cuentas_cobrar_pagar">
                    <ul class="nav nav-collapse">
                        <li class="{{ Request::is('contabilidad/cuentas-por-pagar') ? 'active' : '' }}">
                            <a href="{{ url('contabilidad/cuentas-por-pagar') }}">
                                <span class="sub-item">Cuentas A Pagar</span>
                            </a>
                        </li>
                        <li class="{{ Request::is('contabilidad/cuentas-por-cobrar') ? 'active' : '' }}">
                            <a href="{{ url('contabilidad/cuentas-por-cobrar') }}">
                                <span class="sub-item">Cuentas A Cobrar</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="{{ Request::is('contabilidad/balance') ? 'active' : '' }}">
                <a href="{{ url('contabilidad/balance') }}">
                    <span class="sub-item">Balance General</span>
                </a>
            </li>
        </ul>
    </div>
</li>
<li class="nav-item {{ Request::is('compras') ? 'active' : '' }}">
    <a data-toggle="collapse" href="#compras">
        <i class="fas fa-shopping-basket"></i>
        <p>Compras</p>
        <span class="caret"></span>
    </a>
    <div class="collapse {{ Request::is('compras') ? 'show' : '' }}" id="compras">
        <ul class="nav nav-collapse">
            @foreach ($activeModules as $module)
                @switch($module->getName())
                    @case('Compras')
                        <li class=" {{ Request::is('compras') ? 'active' : '' }}">
                            <a href="{{ url('compras') }}">
                                <span class="sub-item">Crear Pedidos de Compras</span>
                            </a>
                        </li>
                    @break
                @endswitch
            @endforeach
        </ul>
    </div>
</li>
<li class="nav-item {{ Request::is('ventas') ? 'active' : '' }}">
    <a data-toggle="collapse" href="#ventas">
        <i class="fas fa-cart-plus"></i>
        <p>Ventas</p>
        <span class="caret"></span>
    </a>
    <div class="collapse {{ Request::is('ventas') ? 'show' : '' }}" id="ventas">
        <ul class="nav nav-collapse">
            @foreach ($activeModules as $module)
                @switch($module->getName())
                    @case('Ventas')
                        <li class="{{ Request::is('ventas') ? 'active' : '' }}">
                            <a href="{{ url('ventas') }}">
                                <span class="sub-item">Crear Ventas</span>
                            </a>
                        </li>
                    @break
                @endswitch
            @endforeach
        </ul>
    </div>
</li>
<li class="nav-item {{ Request::is('informes') ? 'active' : '' }}">
    <a data-toggle="collapse" href="#informes">
        <i class="fas fa-clipboard-check"></i>
        <p>Informes</p>
        <span class="caret"></span>
    </a>
    <div class="collapse {{ Request::is('informes') ? 'show' : '' }}" id="informes">
        <ul class="nav nav-collapse">
            <li class="{{ Request::is('informes') ? 'active' : '' }}">
                <a href="{{ url('informes') }}">
                    <span class="sub-item">Ver informes en tiempo real</span>
                </a>
            </li>
        </ul>
    </div>
</li>
<li
    class="nav-item {{ Request::is('configuracion') || Request::is('usuario') || Request::is('empresa') || Request::is('configuracion/payments') || Request::is('proveedor') || Request::is('configuracion/Auth/login') || Request::is('import/documents') || Request::is('configuracion/modulos') || Request::is('configuracion/plantillas') || Request::is('configuracion/copias-de-seguridad') ? 'active' : '' }}">
    <a href="{{ url('configuracion') }}">
        <i class="fas fa-cog"></i>
        <p>Configuracion</p>
    </a>
</li>
