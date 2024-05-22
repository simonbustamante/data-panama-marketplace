# Panama Marketplace

### Tabla de Usuarios (`users`)
- `user_id` (PK, Integer): Identificador único del usuario.
- `name` (String): Nombre completo.
- `email` (String): Dirección de correo electrónico.
- `password` (String): Contraseña cifrada.
- `phone` (String): Número de teléfono.
- `address` (String): Dirección principal.
- `role` (Enum): Rol del usuario (administrador, comprador, vendedor).

### Tabla de Tiendas (`stores`)
- `store_id` (PK, Integer): Identificador único de la tienda.
- `user_id` (FK, Integer): Referencia al usuario que es dueño de la tienda.
- `name` (String): Nombre de la tienda.
- `description` (Text): Descripción breve.
- `created_date` (Datetime): Fecha de creación.
- `active` (Boolean): Estado de la tienda.

### Tabla de Productos (`products`)
- `product_id` (PK, Integer): Identificador único del producto.
- `store_id` (FK, Integer): Referencia a la tienda a la que pertenece el producto.
- `name` (String): Nombre del producto.
- `description` (Text): Descripción detallada del producto.
- `price` (Decimal): Precio unitario.
- `stock_quantity` (Integer): Cantidad disponible.
- `category_id` (FK, Integer): Referencia a la categoría.
- `image_url` (String): URL de la imagen del producto.
- `created_date` (Datetime): Fecha de creación.

### Tabla de Categorías (`categories`)
- `category_id` (PK, Integer): Identificador único de la categoría.
- `name` (String): Nombre de la categoría.
- `description` (Text): Descripción breve.

### Tabla de Pedidos (`orders`)
- `order_id` (PK, Integer): Identificador único del pedido.
- `user_id` (FK, Integer): Referencia al usuario que hizo el pedido.
- `order_date` (Datetime): Fecha de creación.
- `status` (Enum): Estado (pendiente, en proceso, enviado, completado, cancelado).
- `total` (Decimal): Importe total.

### Tabla de Detalles de Pedidos (`order_details`)
- `order_detail_id` (PK, Integer): Identificador único del detalle de pedido.
- `order_id` (FK, Integer): Referencia al pedido.
- `product_id` (FK, Integer): Producto pedido.
- `store_id` (FK, Integer): Referencia a la tienda proveedora.
- `quantity` (Integer): Cantidad pedida.
- `price` (Decimal): Precio por unidad al momento del pedido.

### Tabla de Pagos (`payments`)
- `payment_id` (PK, Integer): Identificador único del pago.
- `order_id` (FK, Integer): Referencia al pedido.
- `payment_date` (Datetime): Fecha de realización.
- `amount` (Decimal): Monto pagado.
- `method` (Enum): Método (tarjeta de crédito, PayPal, etc.).

### Tabla de Envíos (`shipments`)
- `shipment_id` (PK, Integer): Identificador único del envío.
- `order_id` (FK, Integer): Referencia al pedido asociado.
- `shipment_date` (Datetime): Fecha de envío.
- `carrier` (String): Empresa transportista.
- `tracking_number` (String): Número de seguimiento.

### Tabla de Comentarios de Productos (`product_reviews`)
- `review_id` (PK, Integer): Identificador único.
- `product_id` (FK, Integer): Referencia al producto comentado.
- `user_id` (FK, Integer): Usuario que dejó el comentario.
- `rating` (Integer): Calificación (1 a 5).
- `comment` (Text): Texto del comentario.
- `review_date` (Datetime): Fecha del comentario.

### Tabla de Reseñas de Tienda (`store_reviews`)
- `review_id` (PK, Integer): Identificador único.
- `store_id` (FK, Integer): Referencia a la tienda reseñada.
- `user_id` (FK, Integer): Usuario que dejó la reseña.
- `rating` (Integer): Calificación (1 a 5).
- `comment` (Text): Texto.
- `review_date` (Datetime): Fecha de la reseña.

### Tabla de Favoritos (`wishlist`)
- `wishlist_id` (PK, Integer): Identificador único.
- `user_id` (FK, Integer): Usuario dueño de la lista.
- `product_id` (FK, Integer): Producto deseado.
- `added_date` (Datetime): Fecha de agregado.

### Tabla de Devoluciones (`returns`)
- `return_id` (PK, Integer): Identificador único.
- `order_id` (FK, Integer): Pedido asociado.
- `product_id` (FK, Integer): Producto devuelto.
- `return_date` (Datetime): Fecha de solicitud.
- `status` (Enum): Estado (solicitado, aprobado, rechazado, procesado).
- `reason` (Text): Razón.

### Tabla de Cupones (`coupons`)
- `coupon_id` (PK, Integer): Identificador único.
- `code` (String): Código.
- `description` (Text): Descripción.
- `discount_amount` (Decimal): Monto.
- `discount_type` (Enum): Tipo (porcentaje o cantidad fija).
- `start_date` (Datetime): Inicio.
- `end_date` (Datetime): Vencimiento.
- `active` (Boolean): Estado.

### Tabla de Recomendaciones (`recommendations`)
- `recommendation_id` (PK, Integer): Identificador único.
- `user_id` (FK, Integer): Usuario receptor.
- `product_id` (FK, Integer): Producto recomendado.
- `created_date` (Datetime): Fecha de creación.
- `status` (string)
- `reason` (string)

### Tabla de Historial de Navegación (`browsing_history`)
- `history_id` (PK, Integer): Identificador único.
- `user_id` (FK, Integer): Usuario que visitó.
- `product_id` (FK, Integer): Producto visitado.
- `visited_date` (Datetime): Fecha de visita.
