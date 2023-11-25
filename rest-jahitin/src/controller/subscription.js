const soapRequest = require('easy-soap-request');
const xmlgetsubs =
`
    <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" 
                        xmlns:ser="http://service.jahitin.com/">
        <soapenv:Header/>
        <soapenv:Body>
            <ser:getAllPendingRequest/>
        </soapenv:Body>
    </soapenv:Envelope>
`
const parseString = require('xml2js')

const getAllSubscriptionController = async (req, res) => {
    try{
        console.log('Get All Subscription Controller');
        const soap = require('soap');
        const url = 'http://soap-app:8003/ws/subscription?wsdl';
        const headers = {
            'Content-Type': 'text/xml;charset=UTF-8',
            'x-api-key': 'RestClient'
        };
        const { response } = await soapRequest({ url: url, headers: headers, xml: xmlgetsubs});
        console.log(response.body);
        const { body, statusCode } = response;
        console.log(body);
        console.log(statusCode);
        parseString.parseString(body, (err, result) => {
            if (err) {
                throw err;
            }
            console.log(result['S:Envelope']['S:Body'][0]['ns2:getAllPendingRequestResponse'][0]['return']);
            res.status(200).json(result['S:Envelope']['S:Body'][0]['ns2:getAllPendingRequestResponse'][0]['return']);
        });
    } catch(err) {
            res.status(400).json({message: 'Error while getting list of pending subscriptions: ' + err.message});
    }
};

const acceptSubscriptionController = async (req, res) => {
    try {
        const { id } = req.params;
        const idInt = parseInt(id);
        console.log(id);
        console.log(idInt);
        const status = `ACCEPTED`;
        console.log(status);
        console.log('Accept Subscription Controller');
        const url = 'http://soap-app:8003/ws/subscription?wsdl';
        const headers = {
            'Content-Type': 'text/xml;charset=UTF-8',
            'x-api-key': 'RestClient'
        };
        const xmlaccsubs =
        `
            <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"
                                xmlns:ser="http://service.jahitin.com/">
                <soapenv:Header/>
                <soapenv:Body>
                    <ser:updateStatus>
                        <arg0>${status}</arg0>
                        <arg1>${idInt}</arg1>
                    </ser:updateStatus>
                </soapenv:Body>
            </soapenv:Envelope>
        `
        console.log(xmlaccsubs);
        const { response } = await soapRequest({ url: url, headers: headers, xml: xmlaccsubs});
        const { body, statusCode } = response;
        console.log(body);
        console.log(statusCode);
        res.status(200).json({message: 'Subscription accepted'});
        parseString.parseString(body, (err, result) => {
            if (err) {
                throw err;
            }
            console.log(result);
        });
    } catch(err) {
        res.status(400).json({message: 'Error while accepting subscription: ' + err.message});
    }
};

const rejectSubscriptionController = async (req, res) => {
    try {
        const { id } = req.params;
        const idInt = parseInt(id);
        console.log(id);
        console.log(idInt);
        const status = `REJECTED`;
        console.log(status);
        console.log('Reject Subscription Controller');
        const url = 'http://soap-app:8003/ws/subscription?wsdl';
        const headers = {
            'Content-Type': 'text/xml;charset=UTF-8',
            'x-api-key': 'RestClient'
        };
        const xmlrejsubs =
        `
            <soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"
                                xmlns:ser="http://service.jahitin.com/">
                <soapenv:Header/>
                <soapenv:Body>
                    <ser:updateStatus>
                        <arg0>${status}</arg0>
                        <arg1>${idInt}</arg1>
                    </ser:updateStatus>
                </soapenv:Body>
            </soapenv:Envelope>
        `
        console.log(xmlrejsubs);
        const { response } = await soapRequest({ url: url, headers: headers, xml: xmlrejsubs});
        const { body, statusCode } = response;
        console.log(body);
        console.log(statusCode);
        res.status(200).json({message: 'Subscription rejected'});
        parseString.parseString(body, (err, result) => {
            if (err) {
                throw err;
            }
            console.log(result);
        });
    } catch(err) {
        res.status(400).json({message: 'Error while rejecting subscription: ' + err.message});
    }
};

module.exports = {
    getAllSubscriptionController,
    acceptSubscriptionController,
    rejectSubscriptionController
};
