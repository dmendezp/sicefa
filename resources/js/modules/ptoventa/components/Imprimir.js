import React, { useState } from 'react'
import Button from 'react-bootstrap/Button'
import Modal from 'react-bootstrap/Modal'

export default function Imprimir(props) {
    const {icon, title, data, products} = props;
    const [show, setShow] = useState(false);

    const handleClose = () => setShow(false);
    const handleShow = () => setShow(true);

    return (
        <>
            <Button variant="primary" onClick={handleShow}>
                Launch demo modal
            </Button>

            <Modal show={show} onHide={handleClose}>
                <Modal.Header closeButton>
                    <Modal.Title>Modal heading</Modal.Title>
                </Modal.Header>
                <Modal.Body>
                <div className="invoice p-3 mb-3">
                {/* title row */}
                <div className="row">
                    <div className="col-12">
                        <h4>
                            <i className={icon} /> {title}
                            <small className="float-right">
                                {/* Date: {moment().format("L")} */}
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
                            <br />
                            Nit. 899.99934-1
                            <br />
                            Producción de Centro - SENA Empresa La Angostura
                            <br />
                            Art 17 Decreto 1001 de 1997
                            <br />
                            {/* Email: info@almasaeedstudio.com */}
                        </address>
                    </div>
                    {/* /.col */}
                    <div className="col-sm-4 invoice-col">
                        <address>
                            <strong>Cliente</strong>
                            <br /> Nombre:
                            { !data || data.length === 0 ? "" : data.first_name +
                                " " +
                                data.first_last_name +
                                " " +
                                data.second_last_name}
                            <br />
                            Documento: {!data || data.length === 0 ? "" : data.document}
                            <br />
                            Phone: (555) 539-1037
                            <br />
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
                   <br />
                   
                    {products}
                </div>
                {/* /.row */}

                {/* this row will not appear when printing */}
                <div className="row no-print">
                    <div className="col-12">
                    </div>
                </div>
            </div>

                </Modal.Body>
                <Modal.Footer>
                    <Button variant="secondary" onClick={handleClose}>
                        Close
                    </Button>
                    <Button variant="primary" onClick={handleClose}>
                        Save Changes
                    </Button>
                </Modal.Footer>
            </Modal>
        </>
    )
}
