const { dbconnet } = require('./config');
const express = require('express');
const { body, validationResult } = require('express-validator');
const { ObjectId } = require('mongodb');
const app = express();
app.use(express.json());
app.use(express.urlencoded({ extended: true }));
app.post('/postdata', [
    body('name').notEmpty().withMessage('Name is Required'),
    body('age').isInt().withMessage('Age WIll be Int Value'),
], async (req, res) => {
    const errors = validationResult(req);
    if (!errors.isEmpty()) {
        res.send(errors);
    }

    const connected = await dbconnet();
    const table = connected.collection('test');
    const data = ['name', 'jai hind', 'ravan'];
    try {
        const insert = await table.insertOne({ name: req.body.name, age: req.body.age, data: data, date: new Date() });

        if (insert) {
            res.json({
                Status: 200,
                Message: "Insert Did Successfullied",

                data: insert
            })
        }
    }
    catch (err) {
        res.Status(500).json({
            Status: 500,
            Message: "Internal Server Error Please Try Again Sometimes",

        });
    }

});
app.get('/getuser', async (req, res) => {
    try {
        const connect = await dbconnet();
        const data = connect.collection('test');

        

// Search
const result = await data.aggregate([
  {$lookup: {
    from: 'test_user',
    localField: '_id',
    foreignField: 'test_id',
    as: 'userDetails'
  }},
   // Project only the necessary fields
]).toArray();

console.log(result);




        if (result.length > 0) {
            const flat = result.flat();
            console.log(result);
            res.status(200).json({
                total: result.length,
                result: result
            });
        } else {
            res.status(404).json({ message: 'No users found with age > 20' });
        }
    } catch (error) {
        console.error('Error fetching users:', error);
        res.status(500).json({ message: 'Internal Server Error' });
    }
});

app.get('/deleteuser/:id', async (req, res) => {
    const id = req.params.id;
    const connect = await dbconnet();
    const data = connect.collection('test');
    const find = await data.deleteOne({ _id: new ObjectId(id) });
    if (find) {
        res.json({
            Status: 200,
            Message: id + '' + 'This ID User Delete Successfully',
        })
    }
    else {
        res.json({
            Status: 404,
            Message: 'ID Did Not Match'
        })
    }
});
app.post('/updateuser', async (req, res) => {
    const id = req.body.id;
    const check = req.query.check;
    const connect = await dbconnet();
    const data = connect.collection('test');
    const find = await data.findOne({ _id: new ObjectId(id) });
    if (id == new ObjectId(id)) {
        console.log('yes match id');
    }
    if (check == '') {
        const Updateuser = await data.updateOne({ _id: new ObjectId(id) }, { $set: { name: req.body.name } });
        if (Updateuser) {
            res.json({
                Status: 200,
                Message: id + '' + 'This User Update Successfully',
            })
        }
        else {
            res.json({
                Status: 404,
                Message: 'ID Did Not Match'
            })
        }
    }
    else {
        const Updateuser = await data.updateOne({ _id: new ObjectId(id) }, { $min: { age: 34 } });
        res.send('Check In Db');
    }

});

app.listen(3000, () => {
    console.log('Server Did Started Successfully at 3000 port');
});
