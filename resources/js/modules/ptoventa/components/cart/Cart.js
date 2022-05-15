import React from 'react';
import ShoppingCart from './ShoppingCart'



class Cart extends React.Component {
	constructor(props){
		super(props);
		this.state = {
			cartItems:  [],
		};

		this.addCartItem = this.addCartItem.bind(this);
		this.changeCartItemQuantity = this.changeCartItemQuantity.bind(this);
		this.removeCartItem = this.removeCartItem.bind(this);
	}

	//Agrego los productos 
	addCartItem(item) {
		let cartItems = this.state.cartItems;
		const index = cartItems.findIndex(x => x.item.id===item.id);

		if(index < 0) {
			const newCartItem = {item: item, quantity: 1};
			cartItems.push(newCartItem);
		} else {
			cartItems[index].quantity++;
		}

		this.setState({cartItems});
	}

	//Actualizo la cantidad de productos
	changeCartItemQuantity(key, quantity) {
		let cartItems = this.state.cartItems;
		const index = cartItems.findIndex(x => x.item.id===key);

		if (index > -1) {
			cartItems[index].quantity = quantity;
			this.setState({cartItems});
		}
	}


	//Elimino el producto con la id que recibo
	removeCartItem(key) {
		let cartItems = this.state.cartItems;
		const index = cartItems.findIndex(x => x.item.id===key);

		if (index > -1) {
			cartItems.splice(index, 1);
			this.setState({cartItems});
		}
	}

	render() {

			return (
				<>
					<ShoppingCart 
						cartItems = {this.state.cartItems}
						changeCartItemQuantity = {this.changeCartItemQuantity}
						removeCartItem = {this.removeCartItem}
						addCartItem={this.addCartItem}
						data={this.props.data}
					/>
				</>
            );
}}

export default Cart;