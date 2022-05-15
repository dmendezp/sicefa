import React,{ useState} from "react";
import Button from 'react-bootstrap/Button';
import Modal from 'react-bootstrap/Modal';
export default function SalesDetails() {

    const [clientShow,setClientShow] = useState(null)
    return (
    <>
        <div className="container-fluid">
            <div className="row justify-content-center">
                <div className="col-md-12">
                    <div className="card card-outline shadow">
              
                        <div className="card-body">
                            <div className="row justify-content-center">
                                <div className="col-md-12">
                                 
                                    <div className="text-center">
                                        <h5>El usuario no existe.</h5>
                                  
                                    </div>
                                    <br></br>
                                        <div className="row justify-content-center">
                                            <div className="col-md-">
                                               {props.AddClientButton}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </>
    );
}
