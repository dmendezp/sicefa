import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Search from './components/Search';
import Cart from './components/cart/Cart';

export class Index extends Component {
    constructor(props) {
        super(props);
        this.state = {
            value: "",
            client: [],
            isLoading: false,
            errorMsg: ''
        };

        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }

    /* 
      Obtengo el valor del input.
    */
    handleChange(event) {
        this.setState({ value: event.target.value });
    }


    /* 
      Ese valor lo envio mediante la Url a la funcion en PHP que hara el llamado
      a la base de datos.
    */
    async handleSubmit(event) {
        event.preventDefault();
        try {

            this.setState({ isLoading: true });

            const response = await axios.get(
                `http://sicefa.test:8081/cafeto/admin/sales/search/${this.state.value}`
            );

            this.setState({ client: response.data, errorMsg: '' });


        } catch (error) {
            this.setState({
                errorMsg: 'Error al cargar. Intenta de nuevo.'
            });
        } finally {
            this.setState({ isLoading: false});
        }
    }
    
    render() {
        const { client, isLoading, errorMsg} = this.state;
        return (<>

            <div className="container-fluid">
                <div className="row">
                    <Search
                        handleSubmit={this.handleSubmit}
                        value={this.state.value}
                        handleChange={this.handleChange}
                        isLoading={isLoading}
                        errorMsg={errorMsg}
                        data={client}
                    />

                    <Cart
                        data={client} />
                </div>
            </div>

        </>
        )
    }
}

if (document.getElementById('pntoventasales')) {
    ReactDOM.render(<Index />, document.getElementById('pntoventasales'));
}
