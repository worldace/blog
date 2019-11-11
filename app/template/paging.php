<?php

global $blog;

print '<nav class="paging">';

if($blog->this_page > 1){
    $prev = $blog->this_page - 1;
    print <<<END
      <a href="$blog->home?action=$blog->action&page=$prev" class="paging-prev">前のページへ</a>
    END;
}

if($blog->this_count > $blog->index_count){
    $next = $blog->this_page + 1;
    print <<<END
      <a href="$blog->home?action=$blog->action&page=$next" class="paging-next">次のページへ</a>
    END;
}

print '</nav>';


$head = <<<'END'
.paging{
    text-align: center;
    font-size: 14px;
    letter-spacing: -1px;
    color: #333;
    vertical-align: middle;
    margin-top: 50px;
}
.paging-prev{
    padding-left: 18px;
    margin-right: 10px;
    background: no-repeat left url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAADAFBMVEUAAAD////z8vRrZ4RKWpUsTq6aobNff8dpidMZT8CAqf56l9KryPyYrdSbsNeetNqvvNO8yeE8edFml916peOPs+eZuuqnxO61zfBPmv54rvhzoN+DrOaGmrbR5P3p8v5+oMiTsNKnvtvX6P3c6/3V4/Xh7v7l8P1Zp/5Zh7hymMOduNXL2urQ3u3c5vHZ4+7p7/Z9vP9cirphjryEu/VtlsGFp8uHqcyLrM6yyN+/0OLm7vbw9/7r8vn5+/38/f6/wMHh6vJiuP6Y0f/r8/rv9frr8fbo8fjs9Prx9vrv9Pj0+Pvy9/ptzP+k5P/2+/16fHyKi4uJoozs9uyBuX5fwVlOmEldoll4sHSa0ZbG4735/Pgyhw9ljU8/cSJtgGLY5dCZuYW80q73+vVTkSZmojt7r1WEsWWMu2WPs2+StnSvz5Tr6+T29vH///7g4N/99sb23lzz1Uv23WfxzjL24Hz45ZP+++/ixFb89NXoyWrx1Hnu0nrnzHn135n35rLu04Lz2Ir16MH++/PbrDzv1JTp1Kn//PbXtn2ulGW7oG/nu3bFk0nYpVj9+/icainZmkf/yYPKpXShhF3r1Lb+8uL069/akDdoRRv/sEzhoVC4h0z37+XbnFPIlFnawaXmzLC7p5Dp4Nb/gwDNfCyrcDL/rln/tWjUnWf/wH/8yZXzzqfPtJj359f//fuPTRL/qFTGgUH/uHX7063+38Kic0z/lUfqtIrrwaL/q3H98+z/omjBmX/+9/P/mWbKubD/UgD/djb/iVbVxsCsn53cAADMAgLuCAjcFhatFRXnMTHa2dn+/v78/Pz7+/v4+Pj39/f09PTx8fHu7u7p6enj4+Pd3d3T09POzs7MzMzJycnHx8fDw8O6urqysrKrq6uenp6WlpaRkZGLi4uEhIRwcHBmZmZKSkqAgIAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAC8CLsUAAAA6XRSTlP/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////AGogZc0AAABySURBVBjTlY+9CoAwDIQvJSp18l27CLqJ0KEP6iZOpT9SB61UB8EsgePy5Y4WPEfgt8DnUi2m0qEkZQctAAYSVUgApvNkdjJwBcBfjFXGegeRyAy27OGdQLoEzZY9h83dUPRRWlO+1Z19JR0bU+b47HIAGG4etZyY1TkAAAAASUVORK5CYII=);
}
.paging-next{
    padding-right: 18px;
    margin-left: 10px;
    background: no-repeat right url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAADAFBMVEUAAAD////z8vRrZ4RKWpUsTq6aobNff8dpidMZT8CAqf56l9KryPyYrdSbsNeetNqvvNO8yeE8edFml916peOPs+eZuuqnxO61zfBPmv54rvhzoN+DrOaGmrbR5P3p8v5+oMiTsNKnvtvX6P3c6/3V4/Xh7v7l8P1Zp/5Zh7hymMOduNXL2urQ3u3c5vHZ4+7p7/Z9vP9cirphjryEu/VtlsGFp8uHqcyLrM6yyN+/0OLm7vbw9/7r8vn5+/38/f6/wMHh6vJiuP6Y0f/r8/rv9frr8fbo8fjs9Prx9vrv9Pj0+Pvy9/ptzP+k5P/2+/16fHyKi4uJoozs9uyBuX5fwVlOmEldoll4sHSa0ZbG4735/Pgyhw9ljU8/cSJtgGLY5dCZuYW80q73+vVTkSZmojt7r1WEsWWMu2WPs2+StnSvz5Tr6+T29vH///7g4N/99sb23lzz1Uv23WfxzjL24Hz45ZP+++/ixFb89NXoyWrx1Hnu0nrnzHn135n35rLu04Lz2Ir16MH++/PbrDzv1JTp1Kn//PbXtn2ulGW7oG/nu3bFk0nYpVj9+/icainZmkf/yYPKpXShhF3r1Lb+8uL069/akDdoRRv/sEzhoVC4h0z37+XbnFPIlFnawaXmzLC7p5Dp4Nb/gwDNfCyrcDL/rln/tWjUnWf/wH/8yZXzzqfPtJj359f//fuPTRL/qFTGgUH/uHX7063+38Kic0z/lUfqtIrrwaL/q3H98+z/omjBmX/+9/P/mWbKubD/UgD/djb/iVbVxsCsn53cAADMAgLuCAjcFhatFRXnMTHa2dn+/v78/Pz7+/v4+Pj39/f09PTx8fHu7u7p6enj4+Pd3d3T09POzs7MzMzJycnHx8fDw8O6urqysrKrq6uenp6WlpaRkZGLi4uEhIRwcHBmZmZKSkqAgIAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAC8CLsUAAAA6XRSTlP/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////AGogZc0AAABxSURBVBjTlY+xDoMwDERfkBOUrf9aRhiRGOh/snVrmkTCDIRUWZDq5WTr6XxnNtrp+PsgRSc+r5Yw/nnqBhNgbN51vgjnnNVs4lw9dlVc8u9CKF1MJAlyEfGLTxJkKaYAgz/339vwWJocaz9Sc9x3OQC5uSDKd86PHAAAAABJRU5ErkJggg==);
}
END;
