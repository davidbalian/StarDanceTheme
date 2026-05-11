<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  xmlns:sitemap="http://www.sitemaps.org/schemas/sitemap/0.9"
  xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">

  <xsl:output method="html" version="5" encoding="UTF-8" indent="yes"/>

  <!-- =====================================================================
       Root: emit the full HTML shell then dispatch to the right template
       ===================================================================== -->
  <xsl:template match="/">
    <html lang="en">
      <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name="robots" content="noindex, follow"/>
        <title>Star Dance Studio — XML Sitemap</title>
        <link rel="preconnect" href="https://fonts.googleapis.com"/>
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="anonymous"/>
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600&amp;display=swap" rel="stylesheet"/>
        <style>
          *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

          body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', system-ui, sans-serif;
            font-size: 14px;
            line-height: 1.5;
            background: #f0f6fb;
            color: #1a2e42;
            min-height: 100vh;
          }

          /* ---- Header ---- */
          .sd-smap-header {
            background: #00386D;
            border-bottom: 3px solid transparent;
            border-image: linear-gradient(90deg, #E4AF78, #DC9A72, #BE6D2B, #EABE81) 1;
            padding: 28px 40px 24px;
          }
          .sd-smap-header__studio {
            font-family: 'Cormorant Garamond', Georgia, serif;
            font-size: 13px;
            font-weight: 400;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: #EABE81;
            margin-bottom: 6px;
          }
          .sd-smap-header__title {
            font-family: 'Cormorant Garamond', Georgia, serif;
            font-size: 28px;
            font-weight: 600;
            color: #ffffff;
            letter-spacing: 0.02em;
          }
          .sd-smap-header__sub {
            margin-top: 6px;
            font-size: 12px;
            color: rgba(255,255,255,0.55);
            letter-spacing: 0.04em;
          }

          /* ---- Body container ---- */
          .sd-smap-body {
            max-width: 1100px;
            margin: 0 auto;
            padding: 32px 24px 60px;
          }

          /* ---- Summary bar ---- */
          .sd-smap-summary {
            background: #ffffff;
            border: 1px solid #d4e6f3;
            border-radius: 8px;
            padding: 14px 20px;
            margin-bottom: 24px;
            font-size: 13px;
            color: #445566;
            display: flex;
            gap: 24px;
            flex-wrap: wrap;
          }
          .sd-smap-summary strong { color: #00386D; font-weight: 600; }

          /* ---- Table ---- */
          .sd-smap-table-wrap {
            background: #ffffff;
            border: 1px solid #d4e6f3;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0,56,109,0.06);
          }
          table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
          }
          thead tr {
            background: #00386D;
          }
          thead th {
            padding: 12px 16px;
            text-align: left;
            font-weight: 600;
            font-size: 11px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.85);
            white-space: nowrap;
          }
          thead th:first-child { padding-left: 20px; }
          tbody tr:nth-child(even) { background: #f7fbff; }
          tbody tr:hover { background: #e8f4fd; }
          tbody td {
            padding: 11px 16px;
            border-bottom: 1px solid #e8f0f7;
            vertical-align: middle;
            color: #334455;
          }
          tbody td:first-child { padding-left: 20px; }
          tbody tr:last-child td { border-bottom: none; }

          /* URL column */
          .sd-smap-url {
            max-width: 480px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
          }
          .sd-smap-url a {
            color: #006bb3;
            text-decoration: none;
            font-size: 13px;
          }
          .sd-smap-url a:hover { text-decoration: underline; color: #00386D; }

          /* Priority badge */
          .sd-smap-prio {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            min-width: 38px;
            text-align: center;
          }
          .sd-smap-prio--high   { background: #d4edda; color: #1a6630; }
          .sd-smap-prio--mid    { background: #d1ecf1; color: #0c5460; }
          .sd-smap-prio--low    { background: #e2e3e5; color: #383d41; }

          /* Image count chip */
          .sd-smap-img-count {
            font-size: 11px;
            color: #667788;
          }
          .sd-smap-img-count span {
            display: inline-block;
            background: #edf3f9;
            border-radius: 12px;
            padding: 1px 8px;
          }

          /* Changefreq */
          .sd-smap-freq { color: #556677; font-size: 12px; }

          /* Lastmod */
          .sd-smap-date { color: #778899; font-size: 12px; font-variant-numeric: tabular-nums; }

          /* Footer */
          .sd-smap-footer {
            margin-top: 28px;
            text-align: center;
            font-size: 11px;
            color: #99aabb;
            letter-spacing: 0.04em;
          }
          .sd-smap-footer a { color: #99aabb; }
        </style>
      </head>
      <body>
        <header class="sd-smap-header">
          <div class="sd-smap-header__studio">Star Dance Studio · Limassol, Cyprus</div>
          <h1 class="sd-smap-header__title">XML Sitemap</h1>
          <p class="sd-smap-header__sub">Generated for search engines — not intended for human navigation</p>
        </header>
        <div class="sd-smap-body">
          <xsl:apply-templates/>
        </div>
        <p class="sd-smap-footer"><a href="https://www.sitemaps.org/protocol.html">Sitemaps 0.9 protocol</a> · Star Dance Studio</p>
      </body>
    </html>
  </xsl:template>

  <!-- =====================================================================
       Sitemap index
       ===================================================================== -->
  <xsl:template match="sitemap:sitemapindex">
    <div class="sd-smap-summary">
      <span>Type: <strong>Sitemap Index</strong></span>
      <span>Sub-sitemaps: <strong><xsl:value-of select="count(sitemap:sitemap)"/></strong></span>
    </div>
    <div class="sd-smap-table-wrap">
      <table>
        <thead>
          <tr>
            <th>Sitemap URL</th>
            <th>Last Modified</th>
          </tr>
        </thead>
        <tbody>
          <xsl:for-each select="sitemap:sitemap">
            <tr>
              <td class="sd-smap-url">
                <a href="{sitemap:loc}"><xsl:value-of select="sitemap:loc"/></a>
              </td>
              <td class="sd-smap-date"><xsl:value-of select="sitemap:lastmod"/></td>
            </tr>
          </xsl:for-each>
        </tbody>
      </table>
    </div>
  </xsl:template>

  <!-- =====================================================================
       URL set
       ===================================================================== -->
  <xsl:template match="sitemap:urlset">
    <div class="sd-smap-summary">
      <span>Type: <strong>URL Set</strong></span>
      <span>URLs: <strong><xsl:value-of select="count(sitemap:url)"/></strong></span>
      <span>Images: <strong><xsl:value-of select="count(sitemap:url/image:image)"/></strong></span>
    </div>
    <div class="sd-smap-table-wrap">
      <table>
        <thead>
          <tr>
            <th>URL</th>
            <th>Last Modified</th>
            <th>Change Freq</th>
            <th>Priority</th>
            <th>Images</th>
          </tr>
        </thead>
        <tbody>
          <xsl:for-each select="sitemap:url">
            <tr>
              <td class="sd-smap-url">
                <a href="{sitemap:loc}"><xsl:value-of select="sitemap:loc"/></a>
              </td>
              <td class="sd-smap-date"><xsl:value-of select="sitemap:lastmod"/></td>
              <td class="sd-smap-freq"><xsl:value-of select="sitemap:changefreq"/></td>
              <td>
                <xsl:call-template name="priority-badge">
                  <xsl:with-param name="prio" select="sitemap:priority"/>
                </xsl:call-template>
              </td>
              <td class="sd-smap-img-count">
                <xsl:if test="count(image:image) &gt; 0">
                  <span><xsl:value-of select="count(image:image)"/></span>
                </xsl:if>
              </td>
            </tr>
          </xsl:for-each>
        </tbody>
      </table>
    </div>
  </xsl:template>

  <!-- =====================================================================
       Named template: priority badge
       ===================================================================== -->
  <xsl:template name="priority-badge">
    <xsl:param name="prio"/>
    <xsl:choose>
      <xsl:when test="$prio = '1.0' or $prio = '0.9'">
        <span class="sd-smap-prio sd-smap-prio--high"><xsl:value-of select="$prio"/></span>
      </xsl:when>
      <xsl:when test="$prio = '0.8' or $prio = '0.7'">
        <span class="sd-smap-prio sd-smap-prio--mid"><xsl:value-of select="$prio"/></span>
      </xsl:when>
      <xsl:otherwise>
        <span class="sd-smap-prio sd-smap-prio--low"><xsl:value-of select="$prio"/></span>
      </xsl:otherwise>
    </xsl:choose>
  </xsl:template>

</xsl:stylesheet>
