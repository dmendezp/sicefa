import React from 'react';
import CartItem from './CartItem'

class ShoppingList extends React.Component {
    constructor(props) {
        super(props);

        this.handleChange = this.handleChange.bind(this);
		this.handleClick = this.handleClick.bind(this);
	}

	handleChange(item,event) {
		this.props.changeCartItemQuantity(item, event.target.value);
	}

	handleClick(event) {
		this.props.removeCartItem(this.props.cartItem.item.key);
	}

    render() {
        let totalPrice = 0;

        if (!this.props.cartItems || this.props.cartItems.length === 0) {
            return (
                <>
                    <div className="col-12 table-responsive">
                        <table className="table table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Producto</th>
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
        else{
        return (
            <>
                <div className="col-12 table-responsive">
                    <table className="table table-striped">
                        <thead>
                            <tr>
                                <th>Qty</th>
                                <th>Product</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                                <th>Acción</th>
                            </tr>
                        </thead>

                        <tbody>
                           
                            {this.props.cartItems.map((producto, index) => (
                                totalPrice += producto.item.amount * producto.quantity,
             
                                    // totalPrice += cartItem.element.amount * cartItem.quantity;
                            <CartItem
                                // data={this.props.data}
                                key={index}
                                producto={producto}
                                totalPrice={totalPrice}
                                changeCartItemQuantity={this.props.changeCartItemQuantity}
                                removeCartItem={this.props.removeCartItem}
                            />
                            ))}
                        </tbody>
                    </table>
                    <div className="row">
                        {/* accepted payments column */}
                        <div className="col-6">
                          
                        </div>
                        {/* /.col */}
                        <div className="col-6">
                            <div className="table-responsive">
                                <table className="table">
                                    <tbody>
                                        <tr>
                                            <th>Total: </th>
                                            <td><h3>$  {totalPrice}</h3></td>
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
}

export default ShoppingList;