<div>
<a href="https://travis-ci.org/leondeng/lawnbotsite.svg">
<img title="Build Status Images" src="https://travis-ci.org/leondeng/lawnbotsite.svg">
</a>
<a href="https://waffle.io/leondeng/lawnbotsite">
<img title="Stories in Ready" src="https://badge.waffle.io/leondeng/lawnbotsite.png?label=ready&title=Ready">
</a>
</div>
<h2
  style="margin: 30px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-size: 20px; font-weight: normal; line-height: 1.5; border-bottom-color: rgb(204, 204, 204); font-family: Arial, sans-serif">
  <br>Problem background
</h2>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">There
  are two parts to the problem (scenario and assumptions made in part 1
  are applicable to part 2, unless started otherwise).</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">Part
  1 is a basic modelling and simulation exercise.</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">Part
  2 extends this to some algorithm development (extension)</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">Part
  3 is for API / full-stack engineers</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="font-size: 16px; line-height: 1.5">Part 1</span><br>
</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)">Nigel has been tinkering in
    his shed again, and has hacked together a robotic controller for his
    lawn mowers. He plans to program each of them to be able to mow all
    the various lawns in his street on their own (another get rich
    scheme for Nigel!). Luckily for Nigel, all the lawns in his street
    are rectangular.</span>
</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)">A mower&#39;s position and
    location is represented by a combination of x and y co-ordinates and
    a letter representing one of the four cardinal compass points (<strong>N</strong>orth,<strong>
      S</strong>outh<strong>, E</strong>ast<strong>, W</strong>est). A lawn is
    divided up into a grid to simplify navigation. An example position
    might be 0, 0, N, which means the mower is in the bottom left corner
    and facing North.
  </span>
</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)">In order to control a mower,
    Nigel sends a simple string of letters. The possible letters are
    &#39;<strong>L</strong>&#39;, &#39;<strong>R</strong>&#39; and &#39;<strong>M</strong>&#39;.
    &#39;L&#39; and &#39;R&#39; makes the mower spin 90 degrees left or
    right respectively, without moving from its current spot.
    &#39;M&#39; means move forward one grid point, and maintain the same
    heading.
  </span><span style="color: rgb(0, 0, 0)"><br></span><span
    style="color: rgb(0, 0, 0)"><br></span><span
    style="color: rgb(0, 0, 0)">Assume that the square directly
    North from (x, y) is (x, y+1).</span>
</p>
<div
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <table style="border-collapse: collapse; margin: 0px">
    <tbody>
      <tr>
        <td
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 10px; vertical-align: top">0,2</td>
        <td
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 10px; vertical-align: top">1,2</td>
        <td
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 10px; vertical-align: top">2,2</td>
      </tr>
      <tr>
        <td
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 10px; vertical-align: top">0,1</td>
        <td
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 10px; vertical-align: top">1,1</td>
        <td
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 10px; vertical-align: top">2,1</td>
      </tr>
      <tr>
        <td
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 10px; vertical-align: top">0,0</td>
        <td
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 10px; vertical-align: top">1,0</td>
        <td
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 10px; vertical-align: top">2,0</td>
      </tr>
    </tbody>
  </table>
</div>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
</p>
<h4
  style="margin: 20px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-size: 14px; line-height: 20px; font-family: Arial, sans-serif">
  <span style="color: rgb(0, 0, 0)">INPUT</span>
</h4>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)"> </span><span
    style="color: rgb(0, 0, 0)">The first line of input is the
    upper-right coordinates of the lawn that is being mowed (i.e the
    size), the lower-left coordinates are assumed to be 0,0.</span>
</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)"> </span><span
    style="color: rgb(0, 0, 0)">The rest of the input is
    information pertaining to the mowers that are going to do the
    mowing. Each mower has two lines of input. The first line gives the
    mower&#39;s position, and the second line is a series of
    instructions telling the mower how to mow the current lawn.</span>
</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)"> </span><span
    style="color: rgb(0, 0, 0)">The position is made up of two
    integers and a letter separated by spaces, corresponding to the x
    and y co-ordinates and the mower&#39;s orientation.</span>
</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)"> </span><span
    style="color: rgb(0, 0, 0)">Mowers must </span><strong><span
    style="color: rgb(0, 0, 0)">not</span></strong><span
    style="color: rgb(0, 0, 0)"> be permitted to bump into each
    other or run each other over - </span><span style="color: rgb(0, 0, 0)">your
    program should detect this and fail appropriately.</span>
</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)"> </span><span
    style="color: rgb(0, 0, 0)"> Once all the mowers have been
    inputted, the program executes and the mowers move about the lawn.<br>
  </span><span style="color: rgb(0, 0, 0)"><br></span><span
    style="color: rgb(0, 0, 0)"> </span>
</p>
<h4
  style="margin: 20px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-size: 14px; line-height: 20px; font-family: Arial, sans-serif">
  <span style="color: rgb(0, 0, 0)">OUTPUT</span>
</h4>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)"> </span><span
    style="color: rgb(0, 0, 0)">The output for each mower should
    be its final co-ordinates and heading.</span>
</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)"><br></span>
</p>
<h4
  style="margin: 20px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-size: 14px; line-height: 20px; font-family: Arial, sans-serif">
  <span style="color: rgb(0, 0, 0)">SAMPLE </span><span
    style="color: rgb(0, 0, 0)">INPUT AND OUTPUT</span>
</h4>
<div
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <table style="border-collapse: collapse; margin: 0px">
    <tbody>
      <tr>
        <th
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 10px; vertical-align: top; background-color: rgb(240, 240, 240)"><code>
            <span style="color: rgb(0, 0, 0)">Test Input:</span><span
              style="color: rgb(0, 0, 0)"><br></span><span
              style="color: rgb(0, 0, 0)">5 5</span><span
              style="color: rgb(0, 0, 0)"><br></span><span
              style="color: rgb(0, 0, 0)">1 2 N</span><span
              style="color: rgb(0, 0, 0)"><br></span><span
              style="color: rgb(0, 0, 0)">LMLMLMLMM</span><span
              style="color: rgb(0, 0, 0)"><br></span><span
              style="color: rgb(0, 0, 0)">3 3 E</span><span
              style="color: rgb(0, 0, 0)"><br></span><span
              style="color: rgb(0, 0, 0)">MMRMMRMRRM</span><span
              style="color: rgb(0, 0, 0)"><br></span><span
              style="color: rgb(0, 0, 0)"><br></span><span
              style="color: rgb(0, 0, 0)"><br></span><span
              style="color: rgb(0, 0, 0)">Expected Output:</span><span
              style="color: rgb(0, 0, 0)"><br></span><span
              style="color: rgb(0, 0, 0)">1 3 N</span><span
              style="color: rgb(0, 0, 0)"><br></span><span
              style="color: rgb(0, 0, 0)">5 1 E</span><span
              style="color: rgb(0, 0, 0)"><br></span><br>
            <span style="color: rgb(0, 0, 0)"> </span>
          </code></th>
      </tr>
    </tbody>
  </table>
</div>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)"><br></span>
</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)"><br></span>
</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)"> </span>
</p>
<hr
  style="border-top-width: 0px; border-right-width: 0px; border-left-width: 0px; border-bottom-style: solid; border-bottom-color: rgb(204, 204, 204); color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)"><br></span>
</p>
<h3
  style="margin: 30px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-size: 16px; line-height: 1.5; font-family: Arial, sans-serif">
  <span style="color: rgb(0, 0, 0)">Part 2</span>
</h3>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)">Nigel hasn&#39;t stopped
    there, no! He has an opportunity to wire his robots onto the
    neighbours lawnmowers as well to make the work even easier. But he
    doesn&#39;t want to reprogram the </span><span style="color: rgb(0, 0, 0)">mowers
    every time he adds a mower.</span>
</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0); line-height: 1.4285715"><br></span>
</p>
<h4
  style="margin: 20px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-size: 14px; line-height: 20px; font-family: Arial, sans-serif">
  <span style="color: rgb(0, 0, 0); line-height: 1.4285715">INPUT</span>
</h4>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0); line-height: 1.4285715">Nigel
    would prefer to change his input file to contain the size of the
    lawn to be mowed, but now include the number of mowers that will be
    mowing. Once again, the first line represents the upper-right
    coordinates of the lawn that is being mowed, but a third number
    indicates the number of mowers that will mow this lawn.</span>
</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)"><br></span>
</p>
<h4
  style="margin: 20px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-size: 14px; line-height: 20px; font-family: Arial, sans-serif">
  <span style="color: rgb(0, 0, 0)">OUTPUT</span>
</h4>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)">This time the output should
    be the instructions that each mower will receive to mow the current
    lawn most efficiently. An efficient instruction set minimises the
    difference between the areas of lawn that each mower covers. There
    may be multiple optimal solutions.</span>
</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)"><br></span>
</p>
<h4
  style="margin: 20px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-size: 14px; line-height: 20px; font-family: Arial, sans-serif">
  <span style="color: rgb(0, 0, 0)">SAMPLE INPUT AND OUTPUT</span>
</h4>
<div
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <table style="border-collapse: collapse; margin: 0px">
    <tbody>
      <tr>
        <th
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 10px; vertical-align: top; background-color: rgb(240, 240, 240)"><p
            style="margin: 0px; padding: 0px">
            <code>
              <span style="color: rgb(0, 0, 0)">Test Input:</span>
            </code>
          </p>
          <p style="margin: 10px 0px 0px; padding: 0px">
            <code>
              <span style="color: rgb(0, 0, 0)">5 5 3</span>
            </code>
          </p>
          <p style="margin: 10px 0px 0px; padding: 0px">
            <code>
              <span style="color: rgb(0, 0, 0)"><br></span>
            </code>
          </p>
          <p style="margin: 10px 0px 0px; padding: 0px">
            <code>
              <span style="color: rgb(0, 0, 0)">Expected Output
                (one possibility):</span>
            </code>
          </p>
          <p style="margin: 10px 0px 0px; padding: 0px">
            <code>
              <span style="color: rgb(0, 0, 0)">0 0 N<br>MMMMMRMRMMMMM<br>
              <br>2 0 N<br>MMMMMRMRMMMMM<br>
              <br>4 0 N<br>MMMMMRMRMMMMM
              </span>
            </code>
          </p></th>
      </tr>
    </tbody>
  </table>
</div>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)"><br></span>
</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)"> </span>
</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)">Notes (internal):</span>
</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)"> </span>
</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)">The algorithm the engineer
    chooses is irrelevant providing they can give sufficient supporting
    evidence that their solution is correct.</span>
</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)">In the above sample, the
    algorithm used is a snaking algorithm.</span>
</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
</p>
<hr
  style="border-top-width: 0px; border-right-width: 0px; border-left-width: 0px; border-bottom-style: solid; border-bottom-color: rgb(204, 204, 204); color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
<h3
  style="margin: 30px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-size: 16px; line-height: 1.5; font-family: Arial, sans-serif">
  <span style="color: rgb(0, 0, 0)">Part 3</span>
</h3>
<div>
  <span style="color: rgb(0, 0, 0)"><br></span>
</div>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)">Nigel has talked to some
    grass-cutting friends and they are all very much impressed with his
    lawn mowing programs. His friends want to use it for themselves but
    do not like bothering Nigel too often as he is only one person and
    cannot keep up with the request (he has many many friends!). So
    Nigel decides to develop an API for his friends to consume (they
    happen to be developers). The functionality provided by the endpoint
    follow the same assumptions as those in Part 1</span>
</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)"><br></span>
</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)">POST /lawn</span>
</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)">Creates a new lawn, with the
    the required dimensions</span>
</p>
<div
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <table style="border-collapse: collapse; margin: 0px">
    <thead>
      <tr>
        <th
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 15px 7px 10px; vertical-align: top; background: 100% 50% no-repeat rgb(240, 240, 240)"><div
            style="margin: 0px; padding: 0px">Request</div></th>
        <th
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 15px 7px 10px; vertical-align: top; background: 100% 50% no-repeat rgb(240, 240, 240)"><div
            style="margin: 0px; padding: 0px">Response</div></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 10px; vertical-align: top"><p
            style="margin: 0px; padding: 0px">
            <span style="color: rgb(0, 0, 0)">{</span>
          </p>
          <p style="margin: 10px 0px 0px; padding: 0px">
            <span style="color: rgb(0, 0, 0)"> width: (NUMBER)</span>
          </p>
          <p style="margin: 10px 0px 0px; padding: 0px">
            <span style="color: rgb(0, 0, 0)"> height: (NUMBER)</span>
          </p>
          <p style="margin: 10px 0px 0px; padding: 0px">
            <span style="color: rgb(0, 0, 0)">}</span>
          </p></td>
        <td
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 10px; vertical-align: top"><p
            style="margin: 0px; padding: 0px">{</p>
          <p style="margin: 10px 0px 0px; padding: 0px">id: (NUMBER)</p>
          <p style="margin: 10px 0px 0px; padding: 0px">width:
            (NUMBER)</p>
          <p style="margin: 10px 0px 0px; padding: 0px">height:
            (NUMBER)</p>
          <p style="margin: 10px 0px 0px; padding: 0px">}</p></td>
      </tr>
    </tbody>
  </table>
</div>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)"><br></span>
</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)">GET /lawn/{id}</span>
</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)">Retrieves a lawn by its Id</span>
</p>
<div
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <table style="border-collapse: collapse; margin: 0px">
    <thead>
      <tr>
        <th
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 15px 7px 10px; vertical-align: top; background: 100% 50% no-repeat rgb(240, 240, 240)"><div
            style="margin: 0px; padding: 0px">Request</div></th>
        <th
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 15px 7px 10px; vertical-align: top; background: 100% 50% no-repeat rgb(240, 240, 240)"><div
            style="margin: 0px; padding: 0px">Response</div></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 10px; vertical-align: top"><p
            style="margin: 0px; padding: 0px"></p></td>
        <td
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 10px; vertical-align: top"><p
            style="margin: 0px; padding: 0px">{</p>
          <p style="margin: 10px 0px 0px; padding: 0px">id: (NUMBER)</p>
          <p style="margin: 10px 0px 0px; padding: 0px">width:
            (NUMBER)</p>
          <p style="margin: 10px 0px 0px; padding: 0px">height:
            (NUMBER),</p>
          <p style="margin: 10px 0px 0px; padding: 0px">mowers: [</p>
          <p style="margin: 10px 0px 0px; padding: 0px">{&lt;mower&gt;}</p>
          <p style="margin: 10px 0px 0px; padding: 0px">]</p>
          <p style="margin: 10px 0px 0px; padding: 0px">}</p></td>
      </tr>
    </tbody>
  </table>
</div>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)">DELETE /lawn/{id}</span>
</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)">Deletes a lawn. ALL mowers
    attached to the lawn are also deleted.</span>
</p>
<div
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <table style="border-collapse: collapse; margin: 0px">
    <thead>
      <tr>
        <th
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 15px 7px 10px; vertical-align: top; background: 100% 50% no-repeat rgb(240, 240, 240)"><div
            style="margin: 0px; padding: 0px">Request</div></th>
        <th
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 15px 7px 10px; vertical-align: top; background: 100% 50% no-repeat rgb(240, 240, 240)"><div
            style="margin: 0px; padding: 0px">Response</div></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 10px; vertical-align: top"><p
            style="margin: 0px; padding: 0px"></p></td>
        <td
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 10px; vertical-align: top"><p
            style="margin: 0px; padding: 0px">{</p>
          <p style="margin: 10px 0px 0px; padding: 0px">status:
            &quot;ok&quot;</p>
          <p style="margin: 10px 0px 0px; padding: 0px">}</p></td>
      </tr>
    </tbody>
  </table>
</div>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)">POST /lawn/{id}/mower</span><span
    style="color: rgb(0, 0, 0)"> </span>
</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)">Creates a new mower on the
    lawn</span>
</p>
<div
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <table style="border-collapse: collapse; margin: 0px">
    <thead>
      <tr>
        <th
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 15px 7px 10px; vertical-align: top; background: 100% 50% no-repeat rgb(240, 240, 240)"><div
            style="margin: 0px; padding: 0px">Request</div></th>
        <th
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 15px 7px 10px; vertical-align: top; background: 100% 50% no-repeat rgb(240, 240, 240)"><div
            style="margin: 0px; padding: 0px">Response</div></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 10px; vertical-align: top"><p
            style="margin: 0px; padding: 0px">{</p>
          <p style="margin: 10px 0px 0px; padding: 0px">x: (NUMBER),</p>
          <p style="margin: 10px 0px 0px; padding: 0px">y: (NUMBER),</p>
          <p style="margin: 10px 0px 0px; padding: 0px">heading:
            (STRING),</p>
          <p style="margin: 10px 0px 0px; padding: 0px">commands:
            (STRING)</p>
          <p style="margin: 10px 0px 0px; padding: 0px">}</p></td>
        <td
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 10px; vertical-align: top"><p
            style="margin: 0px; padding: 0px">{</p>
          <p style="margin: 10px 0px 0px; padding: 0px">id:
            (NUMBER),</p>
          <p style="margin: 10px 0px 0px; padding: 0px">x: (NUMBER),</p>
          <p style="margin: 10px 0px 0px; padding: 0px">y: (NUMBER),</p>
          <p style="margin: 10px 0px 0px; padding: 0px">heading:
            (STRING),</p>
          <p style="margin: 10px 0px 0px; padding: 0px">commands:
            (STRING)</p>
          <p style="margin: 10px 0px 0px; padding: 0px">}</p></td>
      </tr>
    </tbody>
  </table>
</div>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)"><br></span>
</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)">GET /lawn/{id}/mower/{mid}</span>
</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)">Retrieves the mower on the
    lawn by its Id</span>
</p>
<div
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <table style="border-collapse: collapse; margin: 0px">
    <thead>
      <tr>
        <th
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 15px 7px 10px; vertical-align: top; background: 100% 50% no-repeat rgb(240, 240, 240)"><div
            style="margin: 0px; padding: 0px">Request</div></th>
        <th
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 15px 7px 10px; vertical-align: top; background: 100% 50% no-repeat rgb(240, 240, 240)"><div
            style="margin: 0px; padding: 0px">Response</div></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 10px; vertical-align: top"><p
            style="margin: 0px; padding: 0px">{</p>
          <p style="margin: 10px 0px 0px; padding: 0px">}</p></td>
        <td
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 10px; vertical-align: top"><p
            style="margin: 0px; padding: 0px">{</p>
          <p style="margin: 10px 0px 0px; padding: 0px">id:
            (NUMBER),</p>
          <p style="margin: 10px 0px 0px; padding: 0px">x: (NUMBER),</p>
          <p style="margin: 10px 0px 0px; padding: 0px">y: (NUMBER),</p>
          <p style="margin: 10px 0px 0px; padding: 0px">heading:
            (STRING),</p>
          <p style="margin: 10px 0px 0px; padding: 0px">commands:
            (STRING)</p>
          <p style="margin: 10px 0px 0px; padding: 0px">}</p></td>
      </tr>
    </tbody>
  </table>
</div>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)"><br></span>
</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)">PUT /lawn/{id}/mower/{mid}</span><span
    style="color: rgb(0, 0, 0)"> </span>
</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">Updates
  the properties of the mower</p>
<div
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <table style="border-collapse: collapse; margin: 0px">
    <thead>
      <tr>
        <th
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 15px 7px 10px; vertical-align: top; background: 100% 50% no-repeat rgb(240, 240, 240)"><div
            style="margin: 0px; padding: 0px">Request</div></th>
        <th
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 15px 7px 10px; vertical-align: top; background: 100% 50% no-repeat rgb(240, 240, 240)"><div
            style="margin: 0px; padding: 0px">Response</div></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 10px; vertical-align: top"><p
            style="margin: 0px; padding: 0px">{</p>
          <p style="margin: 10px 0px 0px; padding: 0px">x: (NUMBER),</p>
          <p style="margin: 10px 0px 0px; padding: 0px">y: (NUMBER),</p>
          <p style="margin: 10px 0px 0px; padding: 0px">heading:
            (STRING),</p>
          <p style="margin: 10px 0px 0px; padding: 0px">commands:
            (STRING)</p>
          <p style="margin: 10px 0px 0px; padding: 0px">}</p></td>
        <td
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 10px; vertical-align: top"><p
            style="margin: 0px; padding: 0px">{</p>
          <p style="margin: 10px 0px 0px; padding: 0px">id:
            (NUMBER),</p>
          <p style="margin: 10px 0px 0px; padding: 0px">x: (NUMBER),</p>
          <p style="margin: 10px 0px 0px; padding: 0px">y: (NUMBER),</p>
          <p style="margin: 10px 0px 0px; padding: 0px">heading:
            (STRING),</p>
          <p style="margin: 10px 0px 0px; padding: 0px">commands:
            (STRING)</p>
          <p style="margin: 10px 0px 0px; padding: 0px">}</p></td>
      </tr>
    </tbody>
  </table>
</div>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)"><br></span>
</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)">DELETE /lawn/{id}/mower/{id}</span>
</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)">Delete the specific mower on
    the lawn</span>
</p>
<div
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <table style="border-collapse: collapse; margin: 0px">
    <thead>
      <tr>
        <th
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 15px 7px 10px; vertical-align: top; background: 100% 50% no-repeat rgb(240, 240, 240)"><div
            style="margin: 0px; padding: 0px">Request</div></th>
        <th
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 15px 7px 10px; vertical-align: top; background: 100% 50% no-repeat rgb(240, 240, 240)"><div
            style="margin: 0px; padding: 0px">Response</div></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 10px; vertical-align: top"><p
            style="margin: 0px; padding: 0px"></p></td>
        <td
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 10px; vertical-align: top"><p
            style="margin: 0px; padding: 0px">{</p>
          <p style="margin: 10px 0px 0px; padding: 0px">status:
            &quot;ok&quot;</p>
          <p style="margin: 10px 0px 0px; padding: 0px">}</p></td>
      </tr>
    </tbody>
  </table>
</div>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)">POST /lawn/{id}/execute</span>
</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)">Runs a simulation of the lawn
    using the mowers located at the resource. The mowers have their
    positions updated and the lawn is an accurate representation of the
    final state. If any errors occur relevant errors should be returned
    to the client. The list of mowers is in the same order that they
    were added to the lawn.</span>
</p>
<div
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <table style="border-collapse: collapse; margin: 0px">
    <thead>
      <tr>
        <th
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 15px 7px 10px; vertical-align: top; background: 100% 50% no-repeat rgb(240, 240, 240)"><div
            style="margin: 0px; padding: 0px">Request</div></th>
        <th
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 15px 7px 10px; vertical-align: top; background: 100% 50% no-repeat rgb(240, 240, 240)"><div
            style="margin: 0px; padding: 0px">Response</div></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 10px; vertical-align: top"><p
            style="margin: 0px; padding: 0px"></p></td>
        <td
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 10px; vertical-align: top"><p
            style="margin: 0px; padding: 0px">{</p>
          <p style="margin: 10px 0px 0px; padding: 0px">width:
            (NUMBER)</p>
          <p style="margin: 10px 0px 0px; padding: 0px">height:
            (NUMBER)</p>
          <p style="margin: 10px 0px 0px; padding: 0px">mowers: [</p>
          <p style="margin: 10px 0px 0px; padding: 0px">{</p>
          <p style="margin: 10px 0px 0px; padding: 0px">id:
            (NUMBER),</p>
          <p style="margin: 10px 0px 0px; padding: 0px">x: (NUMBER),</p>
          <p style="margin: 10px 0px 0px; padding: 0px">y: (NUMBER),</p>
          <p style="margin: 10px 0px 0px; padding: 0px">heading:
            (STRING),</p>
          <p style="margin: 10px 0px 0px; padding: 0px">commands:
            (STRING)</p>
          <p style="margin: 10px 0px 0px; padding: 0px">}, ....</p>
          <p style="margin: 10px 0px 0px; padding: 0px">]</p>
          <p style="margin: 10px 0px 0px; padding: 0px">}</p></td>
      </tr>
    </tbody>
  </table>
</div>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)"><br></span>
</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)">You can decide on the error
    conditions and response payload (if any), but they should be based
    on the same assumptions you made in Part 1.</span>
</p>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <span style="color: rgb(0, 0, 0)">An example error payload
    could look like this.</span>
</p>
<div
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
  <table style="border-collapse: collapse; margin: 0px">
    <tbody>
      <tr>
        <td
          style="border: 1px solid rgb(221, 221, 221); padding: 7px 10px; vertical-align: top"><p
            style="margin: 0px; padding: 0px">
            <code>
              <span style="color: rgb(0, 0, 0)">{</span>
            </code>
          </p>
          <p style="margin: 10px 0px 0px; padding: 0px">
            <code>
              <span style="color: rgb(0, 0, 0)"> error_code: 123,</span>
            </code>
          </p>
          <p style="margin: 10px 0px 0px; padding: 0px">
            <code>
              <span style="color: rgb(0, 0, 0)"> message:
                &quot;Adding mower to non-empty location&quot;</span>
            </code>
          </p>
          <p style="margin: 10px 0px 0px; padding: 0px">
            <code>
              <span style="color: rgb(0, 0, 0)">}</span>
            </code>
          </p></td>
      </tr>
    </tbody>
  </table>
</div>
<p
  style="margin: 10px 0px 0px; padding: 0px; color: rgb(51, 51, 51); font-family: Arial, sans-serif; font-size: 14px; line-height: 20px">
</p>