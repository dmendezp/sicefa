import React from 'react';

class CartItem extends React.Component {
	constructor(props) {
		super(props);

		this.handleChange = this.handleChange.bind(this);
		this.handleClick = this.handleClick.bind(this);
	}

	handleChange(event) {
		this.props.changeCartItemQuantity(this.props.producto.item.id, event.target.value);
	}

	handleClick(event) {
		this.props.removeCartItem(this.props.producto.item.id);
	}
   
	render() {
        let subTotal = 0;
        subTotal += this.props.producto.item.amount * this.props.producto.quantity;
		return (

                        <React.Fragment key={this.props.index}>
                            <tr>
                                
                                <td>{this.props.index}</td>
                                <td>{this.props.producto.item.element.name}
                                    {/* <input type="hidden" name="people_id" value={this.props.item.element.name} />  */}
                                 </td>
                                <td>
                                    <div className="col-6">
                                        <input
                                            className="form-control"
                                            min='1'
                                            onChange={this.handleChange}
                                            type='number'
                                            name="quantity"
                                            value={this.props.producto.quantity}
                                        />
                                    </div>
                                </td>
                                <td>${subTotal}</td>
                                <td>
                                    <span
                                        className="px-2 text-danger"
                                        style={{
                                            cursor: "pointer",
                                        }}
                                        onClick={this.handleClick}
                                    >
                                        <i className="fas fa-trash" />
                                    </span>
                                </td>
                            </tr>
                           
                        </React.Fragment>      
		);
	
			
        }
}
export default CartItem;