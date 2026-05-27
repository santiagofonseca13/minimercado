# ERP Sistema

ERP web ligero para gestionar `inventario`, `clientes`, `finanzas` y `proveedores` con datos guardados localmente en `IndexedDB`.

## Como funciona hoy

- `Inventario`: alta de productos, entradas, salidas y ventas.
- `Clientes`: registro de clientes e historial de compras y devoluciones.
- `Finanzas`: facturas, ingresos, gastos y notas de credito.
- `Proveedores`: proveedores y pedidos de compra.

## Flujo integrado

- Una venta en `Inventario` descuenta stock y genera una factura `pendiente`.
- Una factura `pagada` en `Finanzas` registra el ingreso y afecta inventario si corresponde.
- Una `nota de credito` repone stock y registra el movimiento financiero de devolucion.
- Un pedido `recibido` en `Proveedores` aumenta stock y registra el gasto una sola vez.

## Tecnologias

- `HTML`, `CSS`, `JavaScript`
- `Bootstrap 5`
- `IndexedDB`
- `Chart.js`
- `SheetJS`

## Uso

1. Abre `index.html` en el navegador.
2. Los datos se guardan localmente en el navegador.
3. No requiere servidor.

## Limitaciones

- No hay multiusuario.
- No hay sincronizacion entre dispositivos.
- Los datos dependen del navegador local.

## Pruebas

Existe una guia de validacion manual en [AUDITORIA_ERP_CHECKLIST.md](AUDITORIA_ERP_CHECKLIST.md).
