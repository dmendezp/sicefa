import React, { useState } from 'react'
import SearchForm from '../templates/search/SearchForm'
import SearchDetails from '../templates/search/SearchDetails'
import Button from 'react-bootstrap/Button'
import Modal from 'react-bootstrap/Modal'

export default function Search(props) {
    const [AddClientShow, setAddClientShow] = useState(false);
    const { handleSubmit, value, handleChange, isLoading, errorMsg, data } = props;

    return (

        <div className="col-md-4">
            <SearchForm
                handleSubmit={handleSubmit}
                value={value}
                handleChange={handleChange}
                isLoading={isLoading}
                errorMsg={errorMsg}
            />

            {data === "" ?


                <SearchDetails
                    AddClientButton={
                        <>
                            <Button variant="secondary" onClick={() => setAddClientShow(true)}>
                               Registrar
                            </Button>

                            <Modal show={AddClientShow} onHide={() => setAddClientShow(false)}>
                                <Modal.Header>
                                    <Modal.Title>Agregar Cliente</Modal.Title>
                                    <Button variant="close" type="button" data-dismiss="modal" aria-label="Close" onClick={() => setAddClientShow(false)}>
                                        <span aria-hidden="true">×</span>
                                    </Button>

                                </Modal.Header>
                                <Modal.Body>

                                </Modal.Body>
                                <Modal.Footer>
                                    <Button variant="secondary" onClick={() => setAddClientShow(false)}>
                                        Close
                                    </Button>
                                </Modal.Footer>
                            </Modal>
                        </>
                    } />
                : ""}
        </div>

    )
}