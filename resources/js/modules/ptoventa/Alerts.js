import React, {useState} from 'react'
import Alert from 'react-bootstrap/Alert'
export default function Alerts(props) {

    const [show, setShow] = useState(true);
    
    // onClose = () => {
    //     $('.alert').slideDown();
    //           setTimeout(function(){
    //           $('.alert').slideUp();
    //         }, 10000);
    // };

    if (show) {
        return (
            <Alert variant="danger" onClose={() => setShow(false)} dismissible>
               <p> {props.AlertMS}</p>
            </Alert>
        );
    }
}
