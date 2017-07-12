jQuery(document).ready(function() {
    var tests = [];
    var points = '';

    tests.push(fixedMenuAnchorUnitTests.testFrontendVariablesSet());
    tests.push(fixedMenuAnchorUnitTests.testFrontendVariablesValues());
    tests.push(fixedMenuAnchorUnitTests.testGetDistance());
    tests.push(fixedMenuAnchorUnitTests.testGetTopValueOfAnchorTargetAlwaysNull());
    tests.push(fixedMenuAnchorUnitTests.testGetTopValueOfAnchorTargetEmulateFetchById());
    tests.push(fixedMenuAnchorUnitTests.testGetTopValueOfAnchorTargetEmulateFetchByName());

    tests.forEach(function(point) { points += point; });
    console.log(points);
    console.log('Tests executed.');
});

var fixedMenuAnchorUnitTests =
{
    /**
     * Returns a mocked jQuery object with the following structure:
     *
     * {
     *      attr(): {
     *          substr(): {
     *          }
     *      },
     *      offset(): {
     *      }
     * }
     *
     * Assumes the following usage: jQuery(), jQuery().attr()
     *
     * @param string identifyBy One of: id, name. If you set id, the init call with [name="foo"] returns null,
     *                          otherwise it assumes it is called with [id="bar"] and returns an object, which
     *                          contains the top property with topValue as value.
     * @param object offSetValues Using that, you can pre-set the top value you expected in the end.
     * @return object jQuery object mock. It is as minimal as neccessary.
     */
    getJQueryMock : function(identifyBy, offSetValues)
    {
        return jQMock = function() {
            return new function() {
                this.attr = function () {
                    return new function() {
                        this.substr = function() { return ''; }
                    }
                }
                this.offset = function() {
                    // depending on what was given by identifyBy,
                    // this method returns null or an object.
                    if ('name' == identifyBy) {
                        return offSetValues.name;
                    } else if ('id' == identifyBy) {
                        return offSetValues.id;
                    } else {
                        return null;
                    }
                }
            }
        }
    },

    /**
     * Helper function for unit testing.
     */
    once : function(fn)
    {
        var returnValue;
        var called = false;
        return function() {
            if (!called) {
                called = true;
                returnValue = fn.apply(this, arguments);
            }
            return returnValue;
        };
    },

    /**
     * Tests, that all frontend variables are set.
     */
    testFrontendVariablesSet : function()
    {
        unitjs.should.exist(fixedMenuAnchorCssClassesToBeIgnored);
        unitjs.should.exist(fixedMenuAnchorMaximumViewportWidth);
        unitjs.should.exist(fixedMenuAnchorMaximumViewportWidthDistance);
        unitjs.should.exist(fixedMenuAnchorUserDefinedDistance);

        return '.';
    },

    /**
     * Tests certain frontend variable values.
     */
    testFrontendVariablesValues : function()
    {
        unitjs.should.equal(true, 0 <= fixedMenuAnchorMaximumViewportWidth);

        return '.';
    },

    /**
     * Tests fixedMenuAnchor_getDistance method.
     */
    testGetDistance : function()
    {
        fixedMenuAnchorMaximumViewportWidth = 42;
        fixedMenuAnchorMaximumViewportWidthDistance = 50;
        unitjs.should.equal(50, fixedMenuAnchor_getDistance(42));

        fixedMenuAnchorMaximumViewportWidth = 42;
        fixedMenuAnchorUserDefinedDistance = 60;
        unitjs.should.equal(60, fixedMenuAnchor_getDistance(100));

        return '.';
    },

    /**
     * Tests fixedMenuAnchor_getTopValueOfAnchorTarget method.
     */

    testGetTopValueOfAnchorTargetAlwaysNull : function()
    {
        var jQueryMock = this.getJQueryMock('name', { id: null, name: null });
        unitjs.should.equal(null, fixedMenuAnchor_getTopValueOfAnchorTarget(jQueryMock, {}));

        return '.';
    },

    testGetTopValueOfAnchorTargetEmulateFetchById : function()
    {
        var jQueryMock = this.getJQueryMock('id', {
            id: {
                top: 100
            },
            name: null
        });

        unitjs.should.equal(100, fixedMenuAnchor_getTopValueOfAnchorTarget(jQueryMock, {}));

        return '.';
    },

    testGetTopValueOfAnchorTargetEmulateFetchByName : function()
    {
        var jQueryMock = this.getJQueryMock('name', {
            id: null,
            name: {
                top: 42
            }
        });

        unitjs.should.equal(42, fixedMenuAnchor_getTopValueOfAnchorTarget(jQueryMock, {}));

        return '.';
    }
};
