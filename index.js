const express = require('express')
const userRouter = require('./Routes/user.routes')
const postRouter = require('./Routes/post.routes')
const PORT = 5000;
const app = express()
app.use(express.json())
app.use('/api', userRouter)
app.use('/api', postRouter)
app.listen(PORT, () => console.log('SERVER START'))