import React from "react";

export default function SalesDetails(props) {
    return (
        <div>
            <div className="card card-outline shadow">
                <div className="card-header">
                    {/* <h3 className="card-title">Sales</h3> */}
                </div>
                {/* /.card-header */}
                <div className="card-body">
                    <div className="row justify-content-center">
                        <div className="col-md-8">
                            {/* {props.data.map(data => <div>{data.document}</div>)} */}
                            <div>{props.data.document}</div>
                            <div>{props.data.first_name}</div>
                            <div className="row justify-content-center">
                            <div className="col-md-3">
                                <input
                                    className="btn btn-primary"
                                    type="submit"
                                    defaultValue="Enviar"
                                />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}
