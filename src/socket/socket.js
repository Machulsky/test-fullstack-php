const io = require('socket.io')(3000)

const Redis = require('ioredis')

const redis = new Redis({
    port: 6379, // Redis port
    host: "redis", // Redis host
    db: 0,
  });

  redis.psubscribe("*", function (err, count) {

  });
  redis.on("pmessage", function (pattern, channel, message) {
      io.emit(channel, message)
    console.log(channel, message)
  });
