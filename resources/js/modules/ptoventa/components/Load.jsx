import React, { Component } from "react";
import "../styles/load.css";

export class Load extends Component {
    render() {
        return (
            <>
            <div className="container-fluid">
                <div className="row">
                    <div className="col-md-12 ">
                        <div className="loader"></div>
                    </div>
                </div>
            </div>
            </>
        );
    }
}

export default Load;
