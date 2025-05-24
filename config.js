const {MongoClient}=require('mongodb');
const url='mongodb://127.0.0.1:27017';
const dbname='karan';
const connect=new MongoClient(url);
const dbconnet=async()=>{
const connected=await connect.connect();
if(connected){
    console.log('Database Connected Successfully');
}
return connected.db(dbname);


// const find=await collection.find().toArray();
// console.log(find);
};

module.exports={dbconnet};

