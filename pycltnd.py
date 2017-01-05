import os,sys,time,urllib,signal,post,yahoo

logfile   = "./pycltnd.log"
errfile   = "./pycltnd.err"
keyfile = "./key.txt"

engine = 'yahoo'
arguments = sys.argv
count=20
interval = 20
if ( "-u" in arguments ):
    u = arguments.index("-u")+1
    posturl = arguments[u]
else:
    sys.stdout.write("Must Input a Target URL -u url\n")
    sys.exit()
if ( "-k" in arguments ):
    k = arguments.index("-k")+1
    try:
        keyfile = arguments[k]
    except:
        keyfile = key.txt
if ( "-t" in arguments ):
    t = arguments.index("-t")+1
    try:
        interval = int(arguments[t])
    except:
        interval = 10
if ( "-c" in arguments ):
    c = arguments.index("-c")+1
    try:
        count = int(arguments[c])
    except:
        count = 20
try:
    keyhd=open(keyfile,'r')
except:
    sys.stdout.write("Can not open %s\n"%keyfile)
    sys.exit()
while True:
    key = keyhd.readline()
    if not key:break
    key=key.strip()
    if len(key) == 0: continue
    post_content = ''
    try:
        if engine == 'yahoo':
            rurl="https://search.yahoo.com/search?p=%s&n=%s"%(urllib.quote(key),count)
            YaCo=yahoo.Yahoo(rurl,'https://www.yahoo.com/')
            post_content = YaCo.filter()
        time.sleep(interval)
    except KeyboardInterrupt:
        sys.stdout.write(("[%s] - %s\n")%(time.ctime(),"Exit: User termination"))
        break
    if (post_content and len(post_content) > 10):
        try:
            pl="%s?action=save&secret=yht123hito"%posturl
            result=post.POST(pl,{"post_title":key,"post_content":post_content}).strip()
            sys.stdout.write(("[%s] - %s - %s\n")%(time.ctime(),key,result))
        except:
            sys.stdout.write(("[%s] - %s - %s\n")%(time.ctime(),key,'publish Failure'))
    else:
        sys.stdout.write(("[%s] - %s - %s\n")%(time.ctime(),key,"Collection Failure"))

    sys.stdout.flush()
#close
sys.exit(0)
