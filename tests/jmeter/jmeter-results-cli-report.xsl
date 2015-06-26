<?xml version="1.0"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">

<!--
   Licensed to the Apache Software Foundation (ASF) under one or more
   contributor license agreements.  See the NOTICE file distributed with
   this work for additional information regarding copyright ownership.
   The ASF licenses this file to You under the Apache License, Version 2.0
   (the "License"); you may not use this file except in compliance with
   the License.  You may obtain a copy of the License at

       http://www.apache.org/licenses/LICENSE-2.0

   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.
-->

<!-- 
  Stylesheet for processing 2.1 output format test result files 
  To uses this directly in a browser, add the following to the JTL file as line 2:
  <? xml-stylesheet type="text/xsl" href="../extras/jmeter-results-report_21.xsl" ?>
  and you can then view the JTL in a browser
-->

<xsl:output method="text" indent="yes" encoding="UTF-8" />

<xsl:param name="titleReport" select="'Load Test Results'"/>
<xsl:param name="dateReport" select="'date not defined'"/>

<xsl:template match="testResults">

    <xsl:call-template name="summary" />

    <xsl:call-template name="pagelist" />

    <xsl:call-template name="detail" />
</xsl:template>

<xsl:template name="summary">
  Summary
  ----------------------------------------------------------------------------
  | # Samples | Failures | Success Rate | Average Time | Min Time | Max Time |
  ----------------------------------------------------------------------------
  <xsl:variable name="allCount" select="count(/testResults/*)" />
  <xsl:call-template name="table-cell">
    <xsl:with-param name="text" select="$allCount"/>
    <xsl:with-param name="padding" select="string-length('# Samples') - string-length($allCount)"/>
  </xsl:call-template>

  <xsl:variable name="allFailureCount" select="count(/testResults/*[attribute::s='false'])" />
  <xsl:call-template name="table-cell">
    <xsl:with-param name="text" select="$allFailureCount"/>
    <xsl:with-param name="padding" select="string-length('Failures') - string-length($allFailureCount)"/>
  </xsl:call-template>

  <xsl:variable name="allSuccessCount" select="count(/testResults/*[attribute::s='true'])" />
  <xsl:variable name="allSuccessCountCell">
    <xsl:call-template name="display-percent">
      <xsl:with-param name="value" select="$allSuccessCount div $allCount" />
    </xsl:call-template>
  </xsl:variable>
  <xsl:call-template name="table-cell">
    <xsl:with-param name="text" select="$allSuccessCountCell"/>
    <xsl:with-param name="padding" select="string-length('Success Rate') - string-length($allSuccessCountCell)"/>
  </xsl:call-template>

  <xsl:variable name="allTotalTime" select="sum(/testResults/*/@t)" />
  <xsl:variable name="allAverageTime">
    <xsl:call-template name="display-time">
      <xsl:with-param name="value" select="$allTotalTime div $allCount" />
    </xsl:call-template>
  </xsl:variable>
  <xsl:call-template name="table-cell">
    <xsl:with-param name="text" select="$allAverageTime"/>
    <xsl:with-param name="padding" select="string-length('Average Time') - string-length($allAverageTime)"/>
  </xsl:call-template>

  <xsl:variable name="allMinTime">
    <xsl:call-template name="min">
      <xsl:with-param name="nodes" select="/testResults/*/@t" />
    </xsl:call-template>
  </xsl:variable>
  <xsl:variable name="allMinTimeCell">
    <xsl:call-template name="display-time">
      <xsl:with-param name="value" select="$allMinTime" />
    </xsl:call-template>
  </xsl:variable>
  <xsl:call-template name="table-cell">
    <xsl:with-param name="text" select="$allMinTimeCell"/>
    <xsl:with-param name="padding" select="string-length('Min Time') - string-length($allMinTimeCell)"/>
  </xsl:call-template>

  <xsl:variable name="allMaxTime">
    <xsl:call-template name="max">
      <xsl:with-param name="nodes" select="/testResults/*/@t" />
    </xsl:call-template>
  </xsl:variable>
  <xsl:variable name="allMaxTimeCell">
    <xsl:call-template name="display-time">
      <xsl:with-param name="value" select="$allMaxTime" />
    </xsl:call-template>
  </xsl:variable>
  <xsl:call-template name="table-cell">
    <xsl:with-param name="text" select="$allMaxTimeCell"/>
    <xsl:with-param name="padding" select="string-length('Max Time') - string-length($allMaxTimeCell)"/>
  </xsl:call-template>

  <xsl:text>|
  ----------------------------------------------------------------------------
  </xsl:text>
</xsl:template>

<xsl:template name="pagelist">
  <xsl:variable name="labelWidth">
    <xsl:for-each select="/testResults/*[not(@lb = preceding::*/@lb)]">
      <xsl:sort select="string-length(@lb)" order="descending" data-type="number" />
      <xsl:if test="position() = 1">
        <xsl:value-of select="string-length(@lb)" />
      </xsl:if>
    </xsl:for-each>
  </xsl:variable>

  Pages
  ----------------------------------------------------------------------------------------
  <xsl:call-template name="table-cell">
    <xsl:with-param name="text" select="'URL'"/>
    <xsl:with-param name="padding" select="$labelWidth - 3"/>
  </xsl:call-template>
  <xsl:call-template name="table-cell">
    <xsl:with-param name="text" select="'# Samples'"/>
  </xsl:call-template>
  <xsl:call-template name="table-cell">
    <xsl:with-param name="text" select="'Failures'"/>
  </xsl:call-template>
  <xsl:call-template name="table-cell">
    <xsl:with-param name="text" select="'Success Rate'"/>
  </xsl:call-template>
  <xsl:call-template name="table-cell">
    <xsl:with-param name="text" select="'Average Time'"/>
  </xsl:call-template>
  <xsl:call-template name="table-cell">
    <xsl:with-param name="text" select="'Min Time'"/>
  </xsl:call-template>
  <xsl:call-template name="table-cell">
    <xsl:with-param name="text" select="'Max Time'"/>
  </xsl:call-template>
  <xsl:text>|
  ----------------------------------------------------------------------------------------
  </xsl:text>

  <xsl:for-each select="/testResults/*[not(@lb = preceding::*/@lb)]">
    <xsl:variable name="label" select="@lb" />
    <xsl:call-template name="table-cell">
      <xsl:with-param name="text" select="$label "/>
      <xsl:with-param name="padding" select="$labelWidth - string-length($label)"/>
    </xsl:call-template>


    <xsl:variable name="count" select="count(../*[@lb = current()/@lb])" />
    <xsl:call-template name="table-cell">
      <xsl:with-param name="text" select="$count"/>
      <xsl:with-param name="padding" select="string-length('# Samples') - string-length($count)"/>
    </xsl:call-template>

    <xsl:variable name="failureCount" select="count(../*[@lb = current()/@lb][attribute::s='false'])" />
    <xsl:call-template name="table-cell">
      <xsl:with-param name="text" select="$failureCount"/>
      <xsl:with-param name="padding" select="string-length('Failures') - string-length($failureCount)"/>
    </xsl:call-template>

    <xsl:variable name="successCount" select="count(../*[@lb = current()/@lb][attribute::s='true'])" />
    <xsl:variable name="successPercent">
      <xsl:call-template name="display-percent">
        <xsl:with-param name="value" select="$successCount div $count" />
      </xsl:call-template>
    </xsl:variable>
    <xsl:call-template name="table-cell">
      <xsl:with-param name="text" select="$successPercent"/>
      <xsl:with-param name="padding" select="string-length('Success Rate') - string-length($successPercent)"/>
    </xsl:call-template>

    <xsl:variable name="totalTime" select="sum(../*[@lb = current()/@lb]/@t)" />
    <xsl:variable name="averageTime">
      <xsl:call-template name="display-time">
        <xsl:with-param name="value" select="$totalTime div $count" />
      </xsl:call-template>
    </xsl:variable>
    <xsl:call-template name="table-cell">
      <xsl:with-param name="text" select="$averageTime"/>
      <xsl:with-param name="padding" select="string-length('Average Time') - string-length($averageTime)"/>
    </xsl:call-template>

    <xsl:variable name="minTime">
      <xsl:call-template name="min">
        <xsl:with-param name="nodes" select="../*[@lb = current()/@lb]/@t" />
      </xsl:call-template>
    </xsl:variable>
    <xsl:variable name="minTimeCell">
      <xsl:call-template name="display-time">
        <xsl:with-param name="value" select="$minTime" />
      </xsl:call-template>
    </xsl:variable>
    <xsl:call-template name="table-cell">
      <xsl:with-param name="text" select="$minTimeCell"/>
      <xsl:with-param name="padding" select="string-length('Min Time') - string-length($minTimeCell)"/>
    </xsl:call-template>

    <xsl:variable name="maxTime">
      <xsl:call-template name="max">
        <xsl:with-param name="nodes" select="../*[@lb = current()/@lb]/@t" />
      </xsl:call-template>
    </xsl:variable>
    <xsl:variable name="maxTimeCell">
      <xsl:call-template name="display-time">
        <xsl:with-param name="value" select="$maxTime" />
      </xsl:call-template>
    </xsl:variable>
    <xsl:call-template name="table-cell">
      <xsl:with-param name="text" select="$maxTimeCell"/>
      <xsl:with-param name="padding" select="string-length('Max Time') - string-length($maxTimeCell)"/>
    </xsl:call-template>

    <xsl:text>|
  ----------------------------------------------------------------------------------------
  </xsl:text>

  </xsl:for-each>
</xsl:template>

<xsl:template name="detail">
  <xsl:variable name="allFailureCount" select="count(/testResults/*[attribute::s='false'])" />

  <xsl:if test="$allFailureCount > 0">
  ------------------
  | Failure Detail |
  ------------------

    <xsl:for-each select="/testResults/*[not(@lb = preceding::*/@lb)]">

      <xsl:variable name="failureCount" select="count(../*[@lb = current()/@lb][attribute::s='false'])" />

      <xsl:if test="$failureCount > 0">
        <xsl:value-of select="@lb" />

        <xsl:for-each select="/testResults/*[@lb = current()/@lb][attribute::s='false']">
          Resonse: <xsl:value-of select="@rc | @rs" /> - <xsl:value-of select="@rm" />
          Failure Message: <xsl:value-of select="assertionResult/failureMessage" />

        </xsl:for-each>

      </xsl:if>

    </xsl:for-each>
  </xsl:if>
</xsl:template>

<xsl:template name="min">
  <xsl:param name="nodes" select="/.." />
  <xsl:choose>
    <xsl:when test="not($nodes)">NaN</xsl:when>
    <xsl:otherwise>
      <xsl:for-each select="$nodes">
        <xsl:sort data-type="number" />
        <xsl:if test="position() = 1">
          <xsl:value-of select="number(.)" />
        </xsl:if>
      </xsl:for-each>
    </xsl:otherwise>
  </xsl:choose>
</xsl:template>

<xsl:template name="max">
  <xsl:param name="nodes" select="/.." />
  <xsl:choose>
    <xsl:when test="not($nodes)">NaN</xsl:when>
    <xsl:otherwise>
      <xsl:for-each select="$nodes">
        <xsl:sort data-type="number" order="descending" />
        <xsl:if test="position() = 1">
          <xsl:value-of select="number(.)" />
        </xsl:if>
      </xsl:for-each>
    </xsl:otherwise>
  </xsl:choose>
</xsl:template>

<xsl:template name="display-percent">
  <xsl:param name="value" />
  <xsl:value-of select="format-number($value,'0.00%')" />
</xsl:template>

<xsl:template name="display-time">
  <xsl:param name="value" />
  <xsl:value-of select="format-number($value,'0 ms')" />
</xsl:template>

<xsl:template name="table-cell">
  <xsl:param name="text" />
  <xsl:param name="padding" select="'0'"/>
  <xsl:text>| </xsl:text>
  <xsl:value-of select="$text"/>
  <xsl:call-template name="append-pad">
    <xsl:with-param name="length" select="$padding + 1"/>
  </xsl:call-template>
</xsl:template>

<xsl:template name="append-pad">
  <xsl:param name="length" select="0"/>
  <xsl:if test="$length != 0">
    <xsl:value-of select="' '" />
    <xsl:call-template name="append-pad">
      <xsl:with-param name="length" select="$length -1"/>
    </xsl:call-template>
  </xsl:if>
</xsl:template>

</xsl:stylesheet>
