import re,sys
src=open('/home/claude/work/harness/premium.src.css').read()
P='html:root:root body.ux'
# '§.auth-body' (no space) -> compound on body
src=src.replace('§.auth-body', P+'.auth-body')
src=src.replace('§ ', P+' ')
open('/home/claude/work/storesrt/storesrt-main/assets/css/premium.css','w').write(src)
print(len(src.splitlines()),'lines;', src.count('§'),'leftover markers')
