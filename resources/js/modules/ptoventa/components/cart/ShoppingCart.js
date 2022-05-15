import React from 'react';
import moment from "moment";
import ShoppingList from './ShoppingList';
import SearchProducts from './SearchProducts';


class ShoppingCart extends React.Component {
    constructor(props) {
        super(props)
    }

    //Implementando el registro en la base de datos
    handleSubmit() {
        axios.get('http://sicefa.test/ptoventa/admin/sales/invoice', {
          })
          .then(function (response) {
            console.log(response);
          })
          .catch(function (error) {
            console.log(error);
          });
    }

    render() {
        return (
            <>
                <div className="col-md-8">
                    <div className="invoice p-3 mb-3">
                        {/* title row */}
                        <div className="row">
                            <div className="col-12">
                                <h4>
                                    <i className="fas fa-shopping-cart" /> Punto de venta
                                    <small className="float-right">
                                        Fecha: {moment().format("L")}
                                    </small>
                                </h4>
                            </div>
                            {/* /.col */}
                        </div>
                        {/* info row */}

                        <div className="row invoice-info">
                            <div className="col-sm-5 invoice-col">
                                <address>
                                    <strong>CENTRO DE FORMACIÓN AGROINDUSTRIAL.</strong>
                                    {/* <br />
                            Nit. 899.99934-1 */}
                                    <br />
                                    Producción de Centro - SENA Empresa La Angostura
                                    {/* <br />
                            Art 17 Decreto 1001 de 1997
                            <br /> */}
                                    {/* Email: info@almasaeedstudio.com */}
                                </address>
                            </div>
                            {/* /.col */}
                            <div className="col-sm-4 invoice-col">
                                <address>
                                    <strong>Cliente</strong>
                                    <br /> Nombre:
                                    {!this.props.data || this.props.data.length === 0 ? "" : this.props.data.first_name +
                                " " +
                                this.props.data.first_last_name +
                                " " +
                                this.props.data.second_last_name}
                            <br />
                            Documento: {!this.props.data || this.props.data.length === 0 ? "" : this.props.data.document}
                            <br />
                                    {/* Phone: (555) 539-1037
                            <br /> */}
                                    {/* Email: john.doe@example.com */}
                                </address>
                            </div>
                            {/* /.col */}
                            <div className="col-sm-3 invoice-col">
                                <b>Factura N° 007612</b>
                                <br />
                                <br />
                            </div>
                            {/* /.col */}
                        </div>
                        {/* /.row */}
                        {/* Table row */}
                        <div className="row">               
                        {!this.props.data || this.props.data.length === 0 ? "" :
                         <SearchProducts 
                             addCartItem={this.props.addCartItem}
                        />}
                        <ShoppingList
                                data={this.props.data}
                                products={this.props.products}
                                cartItems={this.props.cartItems}
                                changeCartItemQuantity={this.props.changeCartItemQuantity}
                                removeCartItem={this.props.removeCartItem}
                            />
                      
                        </div>
                        {/* /.row */}
                        {/* this row will not appear when printing */}
                        <div className="row no-print">
                            <div className="col-12">
                                <form method="get" onSubmit={this.handleSubmit}>
                                    <input type="hidden" name="people_id" value={this.props.data.id}/>
                                    <input type="hidden" name="product_id" value={this.props.cartItems}/>
                                    <input type="hidden" name="amount"/>
                                    <button type="submit"  className="btn btn-default">
                                        <i className="fas fa-print" /> Print
                                    </button>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <div style={{ border: '1px solid', padding: '2px', cursor: 'pointer', width: '100px' }}>
                    Carro ({this.props.cartItems.length})
                </div>
            </>
        );
    }
}

export default ShoppingCart;
