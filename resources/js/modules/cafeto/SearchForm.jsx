import React from "react";

export default function SearchForm(props) {
 
        return (
            <div>
                <div className="card card-outline shadow">
                    <div className="card-header">
                        <h3 className="card-title">Sales</h3>
                    </div>
                    {/* /.card-header */}
                    <div className="card-body">
                        <div className="row justify-content-center">
                            <div className="col-md-8">
                                <form
                                    method="POST"
                                    acceptCharset="UTF-8"
                                    onSubmit={props.handleSubmit}
                                >
                                    <input
                                        type="hidden"
                                        name="_token"
                                        defaultValue="DyRd0muSjN3MGHBFxcLoN21zv7HZsub9iQPjkvse"
                                    />
                                    <input
                                        value={props.value}
                                        onChange={props.handleChange}
                                        // ValidateForm={props.ValidateForm}
                                        className="form-control"
                                        placeholder="Ingrese el documento."
                                        required
                                        name="search"
                                        type="search"
                                    />
                                    {/* <span 
                                    style={{color: "red"}}>
                                        {this.state.error["search"]}
                                    </span> */}
                                    <br />
                                    <div className="row justify-content-center">
                                        <div className="col-md-3">
                                            <input
                                                className="btn btn-primary"
                                                type="submit"
                                                defaultValue="Buscar"
                                            />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }

