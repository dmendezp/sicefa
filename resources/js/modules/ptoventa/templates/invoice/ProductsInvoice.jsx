import React from "react";

export default function ProductsInvoice(props) {
    const { currentProductos, setCurrentProdcutos } = props;

    if (!currentProductos || currentProductos.length === 0) {
        return (
            <>
                <div className="col-12 table-responsive">
                    <table className="table table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Producto</th>
                                <th>Serial #</th>
                                <th>Descripción</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colSpan="7">
                                    <div className="flex-grow-1 d-flex flex-column justify-content-center align-items-center">
                                        <span className="text-secondary">
                                            <em>No hay productos todavía</em>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </>
        );
    }

    function getTotal() {
        let precios = currentProductos.map((producto) => producto.precio);
        let total = precios.reduce((a, b) => a + b, 0);

        return total;
    }

    {
        return (
            <>
                <div className="col-12 table-responsive">
                    <table className="table table-striped">
                        <thead>
                            <tr>
                                <th>Qty</th>
                                <th>Product</th>
                                <th>Serial #</th>
                                <th>Description</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            {currentProductos.map((producto, index) => (
                                <React.Fragment key={index}>
                                    <tr>
                                        <td>{index}</td>
                                        <td>{producto.nombre}</td>
                                        <td>#023</td>
                                        <td>
                                            El snort testosterone trophy driving
                                        </td>
                                        <td>
                                        <div className="col-12">
                                            <input type="number" className="form-control"/>
                                        </div>
                                        </td>
                                        <td>{producto.precio}</td>
                                        <td>
                                            <span
                                                className="px-2 text-danger"
                                                style={{
                                                    cursor: "pointer",
                                                }}
                                                onClick={() => {
                                                    setCurrentProdcutos([
                                                        ...currentProductos.slice(
                                                            0,
                                                            index
                                                        ),
                                                        ...currentProductos.slice(
                                                            index + 1
                                                        ),
                                                    ]);
                                                }}
                                            >
                                                <i className="fas fa-trash" />
                                            </span>
                                        </td>
                                    </tr>
                                </React.Fragment>
                            ))}
                        </tbody>
                    </table>
                    <div className="row">
                        {/* accepted payments column */}
                        <div className="col-6">
                            {/*                           
                            <p
                                className="text-muted well well-sm shadow-none"
                                style={{ marginTop: 10 }}
                            >
                                Etsy doostang zoodles disqus groupon greplin
                                oooj voxy zoodles, weebly ning heekya handango
                                imeem plugg dopplr jibjab, movity jajah plickers
                                sifteo edmodo ifttt zimbra.
                            </p> */}
                        </div>
                        {/* /.col */}
                        <div className="col-6">
                            <div className="table-responsive">
                                <table className="table">
                                    <tbody>
                                        <tr>
                                            {console.log(currentProductos)}
                                            <th>Total:</th>
                                            <td>${getTotal()}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {/* /.col */}
                    </div>
                    {/* /.row */}
                </div>
            </>
        );
    }
}
